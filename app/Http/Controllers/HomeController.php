<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Conge;
use App\Models\Employe;
use App\Models\TypeConge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }



    /////////////////////////////////////////////////////////////////
    // A RECTIFIER/OPTIMISER
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id_employe = $this->getDetailsEmployerIdByUserId()[0]['Employe_id'];
        $type_conge = new TypeConge;
        $type_conges = $type_conge->getAll();
        $conge = new Conge;
        $conges = json_encode($conge->getAll());
        $historiquesCongeEmp = $this->getListCongesEmpJson();
        // dd($historiquesCongeEmp);
        $solde = $this->soldeEmployeJours();
        $dateEmbauche = $this->getDateEmbaucheEmploye();
        $reste_conge = $this->getAbsenceEnAttent();
        $moisJour=$this->getMoisJourAbsenceEnAttent();
        // $historiques = $this->historique_congeJson();
        // return view('home', compact('type_conges', 'conges'));
        return view('home', compact('type_conges', 'conges', 'solde', 'dateEmbauche', 'reste_conge', 'moisJour', 'historiquesCongeEmp'));
    }

    public function insertConge(Request $request)
    {
        $id_employe = $this->getDetailsEmployerIdByUserId()[0]['Employe_id'];
        $conge = new Conge;
        $debut = $request->debut.' '.$request->tpsdebut;
        $fin = $request->fin.' '.$request->tpsfin;
        $data_conge = array([
            'employe_id' => $id_employe,
            'type_conge_id' => $request->type_conge_id,
            'debut' => $request->debut.' '.$request->tpsdebut,
            'fin' => $request->fin.' '.$request->tpsfin,
            'motif' => $request->motif,
            'duree_conge' => DB::raw("TIMESTAMPDIFF(MINUTE,'".$debut."','".$fin."')")
        ]);
        $retour = $conge->insert($data_conge);
        $solde = $this->soldeEmployeJours();
        $data = $conge->getAll();
        $dateEmbauche = $this->getDateEmbaucheEmploye();
        $reste_conge = $this->getAbsenceEnAttent();
        $moisJour=$this->getMoisJourAbsenceEnAttent();
        $historiques = $this->historique_congeJson();
        $historiquesCongeEmp = $conge->getListCongesByEmpId($id_employe);
        return response()->json(['success' => 'abscence ajouter avec succes!', 'data' => $data, 'reste_conge' => $reste_conge,'moisJour'=>$moisJour]);
    }

    //select identifiant employe a partir de son l'user authentifier
    public function getDetailsEmployerIdByUserId()
    {
        $id_user = Auth::user()->id;
        // donnée temporaire
        $details = Employe::where('user_id', '=', $id_user)
            ->get(['id as Employe_id',  'user_id', 'created_at', 'date_embauche']);
        // dd($details[0]['created_at']->format('M-Y'));
        return $details;
    }

    //duree de travail dans l'entreprise
    public function dateValabiliteCongePayeEmploye()
    {
        $employe = $this->getDetailsEmployerIdByUserId();
        for ($i = 0; count($employe); $i++) {
            $nombreJourApresDebutTravail = (DB::raw("TIMESTAMPDIFF(DAY'" . $employe[$i]['created_at'] . "','now()'"));
            if ($nombreJourApresDebutTravail > 365) {
                return 1;
            }
        }
        return 0;
    }

    //Date de premiere embauche vers la date actuelle
    public function getDateEmbaucheEmploye()
    {
        $detailEmp = $this->getDetailsEmployerIdByUserId();
        $datePremierEmbauche = $detailEmp[0]['created_at']->format('M-Y');
        $date_actuelle = now()->format('M-Y');
        return 'De ' . $datePremierEmbauche . ' à ' . $date_actuelle;
    }

    //cumule annnee conge paye par date expiration selon l'entreprise
    public function getCumuleAnneeCongePayeEmploye(Request $request)
    {
        if ($request->input('type_motif_conge_id') == 1) {
            $getDateExpirationConge = TypeConge::where('id', '=', 1)->get(['date_expiration']);
            $anneActuelle = now()->format('Y');
            $anneCumul = (int)$anneActuelle - (int)$getDateExpirationConge[0]['date_expiration'];
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function soldeEmployeJours()
    {
        $detail_employe = $this->getDetailsEmployerIdByUserId();
        $date_embauche = $detail_employe[0]['created_at']->format('Y');
        // echo $date_embauche;
        $date_actuelle = now()->format('Y');
        // echo $date_actuelle;
        $diffAnnee = $date_actuelle - $date_embauche;
    ///solde en minute convertis en jours
        $solde = TypeConge::sum('solde') * 3 / 1440;
        // echo $solde;
        $arrondissementMin = floor($solde);
        $decimal = $solde - $arrondissementMin;
        if ($decimal > 0.5) {
            $solde = ceil($solde);
        } elseif ($decimal > 0 && $decimal <= 0.5) {
            $solde = $arrondissementMin + 0.5;
        }
        return $solde;
    }

    /*public function getHeureAbsenceParMois()
    {
        $congePaye=Conge::join('types_conge as t','conges.type_conge_id','=','types_conge.id')
                        ->where('t.nom_conges')
    }*/


    //Absence en attente
    public function getAbsenceEnAttent()
    {
        $id_employe = $this->getDetailsEmployerIdByUserId()[0]['Employe_id'];
        //dump($id_employe);
        $date_actuelle = now()->format('Y');
        $data = Conge::where('employe_id', '=', $id_employe)
            ->where('etat_conge_id', '=', 3)
            ->whereYear('debut', '=', $date_actuelle)
            ->sum('duree_conge') / 1440;
        // dd($data);
        $arrondissementMin = floor($data);
        $decimal = $data - $arrondissementMin;
        if ($decimal > 0.5) {
            $data = ceil($data);
        } elseif ($decimal > 0 && $decimal <= 0.5) {
            $data = $arrondissementMin + 0.5;
        }
        return $data;
    }
    //Mois d'absence en attente
    public function getMoisJourAbsenceEnAttent()
    {
        $id_employe = $this->getDetailsEmployerIdByUserId()[0]['id'];
        //dump($id_employe);
        $date_actuelle = now()->format('Y');
        $dateDebutMin = Conge::where('employe_id', '=', $id_employe)
            ->where('etat_conge_id', '=', 3)
            ->min('debut');
        $dateFinMax = Conge::where('employe_id', '=', $id_employe)
            ->where('etat_conge_id', '=', 3)
            ->max('fin');

        $var1=new DateTime($dateDebutMin);
        $var2=new DateTime( $dateFinMax);

        return date_format($var1, 'M-d').'  à  '.date_format($var2, 'M-d');
    }

    // La liste de conge de tous les utilisateurs
    public function historique_congeJson(){
        $conges = DB::table('conges')
            ->join('conges_etats_conge', 'etat_conge_id', '=', 'conges_etats_conge.id')
            ->join('conges_types_conge', 'type_conge_id', '=', 'conges_types_conge.id')
            ->join('conges_frequences_solde', 'conges_types_conge.frequence_solde_id', '=', 'conges_frequences_solde.id')
            ->join('employes', 'employe_id', '=', 'employes.id')
            ->get();
        return $conges;
    }

    public function getListCongesEmpJson(){
        $conge = new Conge;
        $id_employe = $this->getDetailsEmployerIdByUserId()[0]['Employe_id'];
        return $conge->getListCongesByEmpId($id_employe);
    }

    public function historique_conge(){
        return view('conge_employe.historique_conge');
    }


}

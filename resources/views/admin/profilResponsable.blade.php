@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Profil résponsable</h3>
@endsection
@section('content')
<style>
    .image-ronde {
        width: 30px;
        height: 30px;
        border: none;
        -moz-border-radius: 75px;
        -webkit-border-radius: 75px;
        border-radius: 75px;
    }

    .hover:hover {
        background-color: rgb(233, 220, 220);
        cursor: pointer;
    }

</style>
<div class="row">
    <div class="row mt-2">

        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations générales </p>

                <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #e8dfe5;">
                    <p class="p-1 m-0" style="font-size: 12px">PHOTO

                    </p>
                    
                        <img src="{{asset('images/responsables/'.$refs->photos)}}" class="image-ronde">
                    </a>
                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    {{-- <a href="{{route('edit_nom',$refs->id)}} "> --}}
                        <p class="p-1 m-0" style="font-size: 12px">NOM<span style="float: right;">{{$refs->nom_resp}} {{$refs->prenom_resp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    {{-- <a href="{{route('edit_naissance',$refs->id)}} "> --}}
                        <p class="p-1 m-0" style="font-size: 12px">ANNIVERSAIRE<span style="float: right;">{{date('j \\ F Y', strtotime($refs->date_naissance_resp))}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    {{-- <a href="{{route('edit_genre',$refs->id)}} "> --}}
                        <p class="p-1 m-0" style="font-size: 12px">GENRE<span style="float: right;">{{$refs->sexe_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>


        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Coordonnées</p>

                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    {{-- <a href="{{route('edit_mail',$refs->id)}} "> --}}
                        <p class="p-1 m-0" style="font-size: 12px">ADRESSE E-MAIL<span style="float: right;">{{$refs->email_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    {{-- <a href="{{route('edit_phone',$refs->id)}} "> --}}
                        <p class="p-1 m-0" style="font-size: 12px">TELEPHONE<span style="float: right;">{{$refs->telephone_resp}}&nbsp;<i class="fas fa-angle-right"></i> </span>

                        </p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    {{-- <a href="{{route('edit_cin',$refs->id)}} "> --}}
                        <p class="p-1 m-0" style="font-size: 12px">CIN<span style="float: right;">{{$refs->cin_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    {{-- <a href="{{route('edit_adresse',$refs->id)}} "> --}}
                        <p class="p-1 m-0" style="font-size: 12px">ADRESSE<span style="float: right;">{{$refs->adresse_lot}} &nbsp;{{$refs->adresse_quartier}} &nbsp;{{$refs->adresse_ville}} &nbsp;{{$refs->adresse_code_postal}}&nbsp;{{$refs->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    {{-- <a href="{{route('edit_fonction',$refs->id)}} "> --}}
                        <p class="p-1 m-0" style="font-size: 12px">FONCTION<span style="float: right;">{{$refs->fonction_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>


                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>
        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations professionnelles</p>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    
                        <p class="p-1 m-0" style="font-size: 12px">Poste responsable<span style="float: right;">{{$refs->poste_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                   
                        <p class="p-1 m-0" style="font-size: 12px">ENTREPRISE<span style="float: right;">{{optional(optional($refs)->entreprise)->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>

                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                                         <a href="#" >
                                     <p class="p-1 m-0" style="font-size: 12px">DEPARTEMENT<span style="float: right;">{{optional(optional($refs)->departement)->nom_departement}}&nbsp;<i class="fas fa-angle-right"></i></span>

                </p>
                </a>
            </div> --}}
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
        </div>
    </div>

</div>

@endsection

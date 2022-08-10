
@component('mail::message', ['nbr_jour'=>$nbr_jour, 'conge'=>$conge])


<p>
Bonjour {{ $conge->employe->nom_emp }} {{ $conge->employe->prenom_emp }},
Votre demande de congé de {{ $nbr_jour }} a été <span class="text_green text_bold">approuvée</span>.
</p>

<p>
Votre congé du {{ date('d-m-Y H:i', strtotime($conge->debut)) }} au {{ date('d-m-Y  H:i', strtotime($conge->fin)) }}
</p>

@component('mail::button', ['url' => ''])
    Voir votre planning
@endcomponent


{{ config('app.name', 'Laravel') }}
@endcomponent

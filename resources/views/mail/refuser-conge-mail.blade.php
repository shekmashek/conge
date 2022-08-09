
@component('mail::message', ['conge'=>$conge])

<p>
Bonjour {{ $conge->employe->nom_emp }} {{ $conge->employe->prenom_emp }},
Votre demande de congé du {{ date('d-m-Y H:i', strtotime($conge->created_at)) }} a été <span class="text_red text_bold">refusée</span>.
</p>

<p>
    Votre congé du {{ date('d-m-Y H:i', strtotime($conge->debut)) }} au {{ date('d-m-Y  H:i', strtotime($conge->fin)) }}
</p>

@component('mail::button', ['url' => ''])
    Voir la suggestion
@endcomponent

{{ config('app.name', 'Laravel') }}
@endcomponent

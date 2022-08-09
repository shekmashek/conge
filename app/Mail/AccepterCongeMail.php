<?php

namespace App\Mail;

use App\Models\Conge;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccepterCongeMail extends Mailable
{
    use Queueable, SerializesModels;

    // public $conge_id;
    public $nbr_jour;
    public $conge;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Conge $conge, $nbr_jour)
    {

        // $conge=Conge::where('id', $conge_id)->first();

        if (gettype($nbr_jour) == 'integer') {
            $this->nbr_jour = $nbr_jour.' jours';
        } else {
            $this->nbr_jour = intval($nbr_jour).' jours et demi';
        }

        $this->conge = $conge;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('upskill-conge@test.com')
                    ->subject('Demande de congé : approuvée')
                    ->markdown('mail.accepter_conge');
    }
}

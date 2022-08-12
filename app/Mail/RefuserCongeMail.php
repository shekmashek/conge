<?php

namespace App\Mail;

use App\Models\Conge;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefuserCongeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $conge;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Conge $conge,$message)
    {
        $this->conge = $conge;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('upskill-conge@test.com')
                    ->subject('Demande de congé : rejeté')
                    ->markdown('mail.refuser-conge-mail');
    }
}

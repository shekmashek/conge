<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Conge;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CongeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $conge;
    public $intervale;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Conge $conge, $intervale)
    {
        $this->intervale = $intervale;
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
                    ->subject('confirmation de conge')
                    ->view('emails.test');
    }
}



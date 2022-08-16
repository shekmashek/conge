<?php

namespace App\Jobs;

use App\Models\Conge;
use Illuminate\Bus\Queueable;
use App\Mail\RefuserCongeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendRejectCongeMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $conge;
    public $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Conge $conge, $message)
    {
        //
        $this->conge = $conge;
        $this->message =$message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::to($this->conge->employe->email_emp)->locale(config('app.locale'))->send(new RefuserCongeMail($this->conge,$this->message));

    }
}

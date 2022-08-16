<?php

namespace App\Jobs;

use App\Models\Conge;
use Illuminate\Bus\Queueable;
use App\Mail\AccepterCongeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendApproveMailCongeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $conge;
    public $nbr_jour;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Conge $conge,$nbr_jour)
    {
        //
        $this->conge = $conge;
        $this->nbr_jour = $nbr_jour;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->conge->employe->email_emp)->locale(config('app.locale'))->send(new AccepterCongeMail($this->conge,$this->nbr_jour));
    }
}

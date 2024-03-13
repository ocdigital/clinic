<?php

namespace App\Jobs;

use App\Mail\NotificacaoConvenio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarEmailConvenioJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $convenio;

    /**
     * Create a new job instance.
     *
     * @param  \App\Convenio  $convenio
     * @return void
     */
    public function __construct($convenio)
    {
        $this->convenio = $convenio;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger('Enviando e-mail para o convênio '.$this->convenio->nome);
        $email = $this->convenio->email;
        Mail::to($email)->send(new NotificacaoConvenio($this->convenio));
    }
}

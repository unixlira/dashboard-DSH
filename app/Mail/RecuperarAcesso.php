<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecuperarAcesso extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($corpo)
    {
        $this->corpo = $corpo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('login/emailenviado')->from('naoresponder@magictv.com.br', 'Não Responder')->subject('Recuperar Senha Dashboard Nagumo')->with('corpo',$this->corpo);
    }
}

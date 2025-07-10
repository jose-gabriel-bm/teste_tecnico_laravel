<?php

namespace App\Mail;

use App\Models\Processo;
use App\Models\Signatario;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProcessNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $processo;
    public $signatario;

    public function __construct(Processo $processo, Signatario $signatario)
    {
        $this->processo = $processo;
        $this->signatario = $signatario;
    }

    public function build()
    {
        $link = route('processes.aprovar', ['id' => $this->processo->id, 'id_signatario' => $this->signatario->id]);

        return $this->subject('Novo processo para aprovação')
            ->markdown('emails.process.notification')
            ->with([
                'processo' => $this->processo,
                'link' => $link,
                'signatario' => $this->signatario,
            ]);
    }

   
}

<?php

namespace App\Jobs;

use App\Models\Signatario;
use App\Models\Processo;
use App\Mail\ProcessNotificationMail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendProcessNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $processo;

    public function __construct(Processo $processo)
    {
        $this->processo = $processo;
    }


    public function handle(): void
    {
        $signatarios = Signatario::all();

        foreach ($signatarios as $signatario) {
            Mail::to($signatario->email)->send(new ProcessNotificationMail($this->processo, $signatario));
        }
    }
}

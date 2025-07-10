<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprovacaoProcesso extends Model
{
    use HasFactory;

    protected $table = 'aprovacoes_processos';

    protected $fillable = [
        'processo_id',
        'signatario_id',
        'status',
        'data_hora',
        'justificativa',
    ];

    public function processo()
    {
        return $this->belongsTo(Processo::class);
    }

    public function signatario()
    {
        return $this->belongsTo(Signatario::class);
    }
}

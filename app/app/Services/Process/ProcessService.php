<?php

namespace App\Services\Process;

use App\Models\Processo;
use App\Models\AprovacaoProcesso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Jobs\SendProcessNotification;
use Illuminate\Support\Facades\DB;

class ProcessService
{
    public function delete($id): void
    {
        $processo = Processo::findOrFail($id);
        $processo->delete();
    }

    public function listAll($perPage = 15)
    {
        // nao tive tempo de terminar de implementar o filtro
        // $query = Signatario::query();       
        // if (!empty($filters['cargo'])) {
        //     $query->where('cargo', $filters['cargo']);
        // }

        return Processo::all();
    }

    public function register(array $data): Processo
    {
        $path = $data['formFile']->store('documentos', 'public');

        $processo = Processo::create([
            'titulo'  => $data['tituloProcesso'],
            'descricao' => $data['descricaoProcesso'],
            'status' => 'pendente',
            'documento' => $path
        ]);

        dispatch(new SendProcessNotification($processo));

        return($processo);
    }

    public function update(array $data): Processo
    {
        $processo = Processo::findOrFail($data['id']);
        $updateData = [
            'titulo'    => $data['editTituloProcesso'],
            'descricao' => $data['editDescricaoProcesso'],
        ];

        if (isset($data['editFormFile']) && $data['editFormFile']) {
            $path = $data['editFormFile']->store('documentos', 'public');
            $updateData['documento'] = $path;
        }

        $processo->update($updateData);

        return $processo;
    }

    public function filter($request)
    {
        $status = $request->input('statusProcesso');

        $query = Processo::query();

        if ($status && $status !== 'todos') {
            $query->where('status', $status);
        }

        $processos = $query->get();

        return $processos;
    }

    public function aprovacoesProcessos($request)
    {
        DB::transaction(function () use ($request) {

            AprovacaoProcesso::create([
            'processo_id'    => $request->input('id_processo'),
            'signatario_id'  => $request->input('id_signatario'),
            'status'         => $request->input('status'),
            'data_hora'      => now(),
            'justificativa'  => $request->input('justificativa'),
        ]);

        $jaReprovado = AprovacaoProcesso::where('processo_id', $request->input('id_processo'))
            ->where('status', 'reprovado')
            ->exists();

        $processo = Processo::findOrFail($request->input('id_processo'));

        if ($jaReprovado) {
            $processo->status = 'reprovado';
            $processo->save();
        } elseif ($request->input('status') === 'reprovado') {
            $processo->status = 'reprovado';
            $processo->save();
        }else{
            $processo->status = 'aprovado';
            $processo->save();
        }
    });
    }
}

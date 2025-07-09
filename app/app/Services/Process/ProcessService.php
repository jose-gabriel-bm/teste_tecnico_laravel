<?php

namespace App\Services\Process;

use App\Models\Processo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

        return Processo::create([
            'titulo'  => $data['tituloProcesso'],
            'descricao' => $data['descricaoProcesso'],
            'status' => 'pendente',
            'documento' => $path
        ]);
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
}

<?php

namespace App\Services\Signatario;

use App\Models\Signatario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SignatoryService
{
    public function delete($id): void
    {
        $signatario = Signatario::findOrFail($id);
        $signatario->delete();
    }

    public function listAll($perPage = 15)
    {
        // nao tive tempo de terminar de implementar o filtro
        // $query = Signatario::query();       
        // if (!empty($filters['cargo'])) {
        //     $query->where('cargo', $filters['cargo']);
        // }

        return Signatario::all();
    }

    public function register(array $data): Signatario
    {
        return Signatario::create([
            'nome'  => $data['signatarioName'],
            'email' => $data['signatarioEmail'],
            'cargo' => $data['signatarioCargo'],
        ]);
    }

    public function update(array $data): Signatario
    {
        $signatario = Signatario::findOrFail($data['id']);
    
        $signatario->update([
            'nome'  => $data['editSignatarioName'],
            'email' => $data['editSignatarioEmail'],
            'cargo' => $data['editSignatarioCargo'],
        ]);
    
        return $signatario;
    }
}

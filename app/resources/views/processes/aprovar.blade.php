@extends('layouts.base')

@section('title', 'Tela Aprovação')

@section('sidebar', '')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card shadow" style="width: 400px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Aprovação de Processo</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('processes.aprovacoesProcessos') }}">
                @csrf

                <input type="hidden" name="id_processo" value="{{ $processo->id }}">
                <input type="hidden" name="id_signatario" value="{{ $id_signatario }}">

                <table class="table table-sm">
                    <tr>
                        <td><strong>Título:</strong> {{ $processo->titulo }}</td>
                    </tr>
                    <tr>
                        <td><strong>Descrição:</strong> {{ $processo->descricao }}</td>
                    </tr>
                </table>

                <div class="form-group mt-3">
                    <label>Decisão:</label><br>
                    <input type="radio" name="status" value="aprovado" id="aprovado"
                        {{ (old('status', $status ?? '') === 'aprovado') ? 'checked' : '' }}>
                    <label for="aprovado">Aprovar</label><br>
                    <input type="radio" name="status" value="reprovado" id="reprovado"
                        {{ (old('status', $status ?? '') === 'reprovado') ? 'checked' : '' }}>
                    <label for="reprovado">Reprovar</label>
                </div>

                <div class="form-group mt-3" id="justificativa-container" style="display: none;">
                    <label for="justificativa">Justificativa</label>
                    <textarea name="justificativa" id="justificativa" rows="3" class="form-control"
                        placeholder="Informe o motivo">{{ old('justificativa', $justificativa ?? '') }}</textarea>
                    @error('justificativa')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleJustificativa() {
        const aprovado = document.getElementById('aprovado');
        const reprovado = document.getElementById('reprovado');
        const justificativa = document.getElementById('justificativa-container');

        if (reprovado.checked) {
            justificativa.style.display = 'block';
        } else {
            justificativa.style.display = 'none';
        }
    }

    document.getElementById('aprovado').addEventListener('change', toggleJustificativa);
    document.getElementById('reprovado').addEventListener('change', toggleJustificativa);

    window.addEventListener('load', toggleJustificativa);
</script>
@endsection

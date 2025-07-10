@extends('layouts.base')

@section('title', 'Tela Aprovação')

@section('sidebar', '')

@section('content')

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Processo</th>
      <th scope="col">Signatário</th>
      <th scope="col">Status</th>
      <th scope="col">Data e Hora</th>
      <th scope="col">Justificativa</th>
    </tr>
  </thead>
  <tbody class="table-group-divider" style="color: #0d6dfd8a">
    @forelse ($historico as $index => $historic)
      <tr>
        <td>{{ $historic->processo->titulo }}</td>
        <td>{{ $historic->signatario->nome }}</td>
        <td style="text-transform: capitalize; color:
          {{ $historic->status === 'reprovado' ? 'red' : 
          ($historic->status === 'aprovado' ? 'green' : 
          ($historic->status === 'pendente' ? 'orange' : 'black')) }}">
          {{ $historic->status }}
        </td>

        <td>{{ \Carbon\Carbon::parse($historic->data_hora)->format('d/m/Y H:i') }}</td>

        <td>{{ $historic->justificativa }}</td>

      </tr>
    @empty
      <tr>
        <td colspan="5" class="text-center">Nenhum Historico de processo cadastrado.</td>
      </tr>
    @endforelse
  </tbody>
</table>


@endsection
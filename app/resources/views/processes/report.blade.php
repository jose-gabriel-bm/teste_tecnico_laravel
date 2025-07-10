@extends('layouts.base')

@section('title', 'Tela de Relatorios')

@section('content')

<div class="container mt-5">
    <div class="dropdown mb-4">
      <button type="button " class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
        <i class="bi bi-filter me-2"></i> Filtros
      </button>
        <form class="dropdown-menu p-4" style="width: 300px;" method="GET" action="{{ route('processes.filter') }}">
        @csrf
        <div class="mb-3">
            <label for="statusProcesso" class="form-label">Status</label>
            <select name="statusProcesso" id="statusProcesso" class="form-select" required autofocus>
              <option value="" disabled selected>Selecione um status</option>
              <option value="aprovado">Aprovado</option>
              <option value="pendente">Pendente</option>
              <option value="reprovado">Reprovado</option>
              <option value="todos">Todos</option>
            </select>
            @error('statusProcesso')
              <span style="font-size: 12px; color:red">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
      </form>
    </div>


<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titulo</th>
      <th scope="col">Status</th>
      <th scope="col">Descrição</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody class="table-group-divider" style="color: #0d6dfd8a">
    @forelse ($processos as $index => $processo)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $processo->titulo }}</td>
        <td style="text-transform: capitalize; color:
          {{ $processo->status === 'reprovado' ? 'red' : 
          ($processo->status === 'aprovado' ? 'green' : 
          ($processo->status === 'pendente' ? 'orange' : 'black')) }}">
          {{ $processo->status }}
        </td>

        <td>{{ $processo->descricao }}</td>
        <td>
          <div class="dropdown">
            <button class="btn btn-light btn-sm rounded-circle" type="button" id="dropdownMenuButton" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li>
              



                  <button class="dropdown-item text-primary" onclick="window.location='{{ route('processes.historico') }}?id={{ $processo->id }}'">
                    <i class="bi bi-card-checklist me-2"></i> Histórico
                  </button>
              
              </li>
            </ul>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5" class="text-center">Nenhum Processo cadastrado.</td>
      </tr>
    @endforelse
  </tbody>
</table>

@endsection
@extends('layouts.base')

@section('title', 'Tela de Signatários')

@section('content')
  <div class="container mt-5">
   
<div class="dropdown mb-4">
  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
    <i class="bi bi-plus-circle-fill me-2"></i> Adicionar
  </button>
  <form class="dropdown-menu p-4" style="width: 400px;" method="POST" action="{{ route('signatory.register') }}">
    @csrf
    <div class="mb-3">
      <label for="signatarioName" class="form-label">Nome</label>
      <input type="text" name="signatarioName" id="signatarioName" class="form-control" required autofocus value="{{old('signatarioName')}}">
      @error('signatarioName')
        <span style="font-size: 12px; color:red">{{ $message }}<span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="signatarioEmail" class="form-label">E-mail</label>
      <input type="email" class="form-control" name="signatarioEmail" id="signatarioEmail" placeholder="email@example.com" required value="{{old('signatarioEmail')}}">
      @error('signatarioEmail')
        <span style="font-size: 12px; color:red">{{ $message }}<span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="signatarioCargo" class="form-label">cargo</label>
      <input type="text" class="form-control" name="signatarioCargo" id="signatarioCargo" required value="{{old('signatarioCargo')}}">
      @error('signatarioCargo')
        <span style="font-size: 12px; color:red">{{ $message }}<span>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>




<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Cargo</th>
      <th scope="col">E-mail</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody class="table-group-divider" style="color: #0d6dfd8a">
    @forelse ($signatarios as $index => $signatario)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $signatario->nome }}</td>
        <td>{{ $signatario->cargo }}</td>
        <td>{{ $signatario->email }}</td>
        <td>
          <div class="dropdown">
            <button class="btn btn-light btn-sm rounded-circle" type="button" id="dropdownMenuButton" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li>
              



<div class="dropdown mb-0">
  <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
    <i class="bi bi-pencil-square "></i> Editar
  </button>
  <form class="dropdown-menu p-4" style="width: 400px;" method="POST" action="{{ route('signatory.update') }}">
    @csrf
    <input type="hidden" name="id" id="id" value="{{old('id', $signatario->id)}}">

    <div class="mb-3">
      <label for="editSignatarioName" class="form-label">Nome</label>
      <input type="text" name="editSignatarioName" id="editSignatarioName" class="form-control" required autofocus value="{{old('editSignatarioName', $signatario->nome)}}">
      @error('editSignatarioName')
        <span style="font-size: 12px; color:red">{{ $message }}<span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="editSignatarioEmail" class="form-label">E-mail</label>
      <input type="email" class="form-control" name="editSignatarioEmail" id="editSignatarioEmail" placeholder="email@example.com" required value="{{old('editSignatarioEmail', $signatario->email)}}">
      @error('editSignatarioEmail')
        <span style="font-size: 12px; color:red">{{ $message }}<span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="editSignatarioCargo" class="form-label">cargo</label>
      <input type="text" class="form-control" name="editSignatarioCargo" id="editSignatarioCargo" required value="{{old('editSignatarioCargo', $signatario->cargo)}}">
      @error('editSignatarioCargo')
        <span style="font-size: 12px; color:red">{{ $message }}<span>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Editar</button>
  </form>
</div>


              
              </li>
              <li>
                <form method="POST" action="{{ route('signatory.destroy', $signatario->id) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                    <i class="bi bi-trash3-fill me-2"></i> Excluir
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5" class="text-center">Nenhum signatário cadastrado.</td>
      </tr>
    @endforelse
  </tbody>
</table>







  </div>
@endsection
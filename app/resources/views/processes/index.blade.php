@extends('layouts.base')

@section('title', 'Tela de Signatários')

@section('content')
  <div class="container mt-5">
    <div class="dropdown mb-4">
      <button type="button " class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
        <i class="bi bi-plus-circle-fill me-2"></i> Adicionar
      </button>
      <form class="dropdown-menu p-4" style="width: 400px;" method="POST" enctype="multipart/form-data" action="{{ route('processes.register') }}">
        @csrf

        <div class="mb-3">
          <label for="tituloProcesso" class="form-label">Titulo</label>
          <input type="text" name="tituloProcesso" id="tituloProcesso" class="form-control" required autofocus value="{{old('tituloProcesso')}}">
          @error('tituloProcesso')
            <span style="font-size: 12px; color:red">{{ $message }}<span>
          @enderror
        </div>
      
        <div class="mb-0">
          <label for="descricaoProcesso" class="form-label">Descrição</label>
          <textarea class="form-control" name="descricaoProcesso" id="descricaoProcesso" rows="2" required value="{{old('descricaoProcesso')}}"></textarea>
          @error('descricaoProcesso')
            <span style="font-size: 12px; color:red">{{ $message }}<span>
          @enderror
        </div>


        <div class="mb-3">
          <label for="formFile" class="form-label"></label>
          <input name="formFile" class="form-control" type="file" id="formFile" required>
        </div>
      
        <button type="submit" class="btn btn-primary">Salvar</button>
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
              



                <div class="dropdown mb-0">
                  <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    <i class="bi bi-pencil-square "></i> Editar
                  </button>
                  <form class="dropdown-menu p-4" style="width: 400px;" method="POST" enctype="multipart/form-data" action="{{ route('processes.update') }}">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{old('id', $processo->id)}}">
                  

                    <div class="mb-3">
                      <label for="editTituloProcesso" class="form-label">Titulo</label>
                      <input type="text" name="editTituloProcesso" id="editTituloProcesso" class="form-control" required autofocus value="{{old('editTituloProcesso', $processo->titulo)}}">
                      @error('editTituloProcesso')
                        <span style="font-size: 12px; color:red">{{ $message }}<span>
                      @enderror
                    </div>
                  
                    <div class="mb-3">
                      <label for="editDescricaoProcesso" class="form-label">Descrição</label>
                      <textarea class="form-control" name="editDescricaoProcesso" id="editDescricaoProcesso" rows="2" autofocus required> {{old('editDescricaoProcesso', $processo->descricao)}}</textarea>
                      @error('editDescricaoProcesso')
                        <span style="font-size: 12px; color:red">{{ $message }}<span>
                      @enderror
                    </div>
                 
                  
                    <div class="mb-3">
                      <label class="form-label" style="font-size: 10px">* Subistituir Documento ? </label>
                      <label for="editFormFile" class="form-label"></label>
                      <input name="editFormFile" class="form-control" type="file" id="editFormFile">
                    </div>

                  
                    <button type="submit" class="btn btn-primary">Editar</button>
                  </form>
                </div>


              
              </li>
              <li>
                <form method="POST" action="{{ route('processes.destroy', $processo->id) }}">
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
        <td colspan="5" class="text-center">Nenhum Processo cadastrado.</td>
      </tr>
    @endforelse
  </tbody>
</table>







  </div>
@endsection
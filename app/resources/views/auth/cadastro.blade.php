@extends('layouts.base')

@section('title', 'Cadastro de Usuário')

@section('sidebar', '')

@section('content')

 <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-4 text-center titulo_auth">Cadastre-se</h4>

                    <form class="input_geral" method="POST" action="{{ route('register') }}">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 btn_submit">Cadastrar</button>
                    </form>
                    <p class="text-center mt-3 text-muted">Já tem conta? <a href="{{ route('login.form') }}">Entrar</a></p>
                </div>
            </div>


        </div>
    </div>

@endsection
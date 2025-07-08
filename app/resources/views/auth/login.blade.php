
@extends('layouts.base')

@section('title', 'Tela de Login')

@section('sidebar', '')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-4 text-center titulo_auth" >Entrar</h4>
                    <form class="input_geral" method="POST" action="{{ route('logar') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required autofocus value="{{old('email')}}">
                            @error('email')
                                <span style="font-size: 12px; color:red">{{ $message }}<span>
                            @enderror   
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" name="password" id="password" class="form-control" required value="{{old('password')}}">
                            @error('password')
                                <span style="font-size: 12px; color:red">{{ $message }}<span>
                            @enderror   
                        </div>

                        <button type="submit" class="mt-4 btn btn-primary w-100 btn_submit">Entrar</button>
                    </form>
                    <p class="text-center mt-3 text-muted">Não possui conta? <a href="{{ route('register.form') }}">Registre-se</a></p>
                </div>
            </div>

            <p class="text-center mt-3 text-muted">© {{ date('Y') }} - Sistema de Assinatura</p>
        </div>
    </div>

@endsection
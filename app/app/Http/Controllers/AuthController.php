<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Auth\RegisterUserService;
use App\Http\Requests\Auth\RegisterUserRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.cadastro');
    }

    public function logar(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (!Auth::attempt($credentials)) {
                throw ValidationException::withMessages([
                    'email' => ['E-mail ou senha inválidos.'],
                ]);
            }

            $request->session()->regenerate();

            return redirect()
                ->intended('/signatarios/listagem')
                ->with('success', 'Login realizado com sucesso!');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro inesperado ao tentar fazer login.')
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register(RegisterUserRequest $request, RegisterUserService $service)
    {
        try {
            $service->execute($request->validated());

            return redirect()
                ->route('login')
                ->with('success', 'Usuário cadastrado com sucesso!');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao cadastrar o usuário.')
                ->withInput();
        }
    }
}

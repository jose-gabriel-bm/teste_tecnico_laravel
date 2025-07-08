<?php

namespace App\Http\Controllers;

use App\Models\Signatario;
use App\Services\Signatario\SignatoryService;
use App\Http\Requests\Signatario\RegisterSignatoryRequest;
use App\Http\Requests\Signatario\EditSignatoryRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class SignatoryController extends Controller
{
    protected $signatarioService;

    public function __construct(SignatoryService $signatarioService)
    {
        $this->signatarioService = $signatarioService;
    }

    public function index()
    {
        $signatarios = $this->signatarioService->listAll();
        return view('signatory.index', compact('signatarios'));
    }

    public function register(RegisterSignatoryRequest $request)
    {
        try {
            $this->signatarioService->register($request->validated());

            return redirect()
                ->back()
                ->with('success', 'Signatario cadastrado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao cadastrar o signatario.')
                ->withInput();
        }
    }

    public function update(EditSignatoryRequest $request)
    {
        try {
            $this->signatarioService->update($request->validated());

            return redirect()
                ->back()
                ->with('success', 'Signatario cadeditado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao editar o signatario.')
                ->withInput();
        }
    }


    public function destroy($id)
    {
        try {
            $this->signatarioService->delete($id);

            return redirect()
                ->back()
                ->with('success', 'Signatário excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao excluir o signatário.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Process\ProcessService;
use App\Http\Requests\Process\RegisterProcessRequest;
use App\Http\Requests\Process\EditProcessRequest;


class ProcessesController extends Controller
{
    protected $processService;

    public function __construct(ProcessService $processService)
    {
        $this->processService = $processService;
    }

    public function index()
    {
        $processos = $this->processService->listAll();
        return view('processes.index', compact('processos'));
    }

    public function register(RegisterProcessRequest $request)
    {
        try {
            $this->processService->register($request->validated());

            return redirect()
                ->back()
                ->with('success', 'Processo cadastrado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao cadastrar o Processo.')
                ->withInput();
        }
    }

    public function update(EditProcessRequest $request)
    {
        try {
            $this->processService->update($request->validated());

            return redirect()
                ->back()
                ->with('success', 'Processo editado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao editar o Processo.')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->processService->delete($id);

            return redirect()
                ->back()
                ->with('success', 'Processo excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao excluir o Processo.');
        }
    }
}

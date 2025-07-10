<?php

namespace App\Http\Controllers;

use App\Models\Processo;
use App\Models\AprovacaoProcesso;

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

    public function filter(Request $request)
    {
        $processos = $this->processService->filter($request);

        return view('processes.report', compact('processos'));
    }

    public function index()
    {
        $processos = $this->processService->listAll();
        return view('processes.index', compact('processos'));
    }

    public function report()
    {
        $processos = $this->processService->listAll();
        return view('processes.report', compact('processos'));
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

    public function aprovar(Request $request)
    {
        $id = $request->query('id');
        $id_signatario = $request->query('id_signatario');
        $processo = Processo::findOrFail($id);

        return view('processes.aprovar', compact('processo', 'id_signatario'));
    }

    public function aprovacoesProcessos(Request $request)
    {
         try {
            $this->processService->aprovacoesProcessos($request);

            return redirect()
                ->route('login')
                ->with('success', 'sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro');
        }
    }

    public function historico(Request $request)
    {
        
        $id = $request->query('id');
        
        $historico = AprovacaoProcesso::with(['processo', 'signatario'])
            ->where('processo_id', $id)
            ->get();

        return view('processes.historico', compact('historico'));
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Chamados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChamadosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $chamados;

    public function __construct(Chamados $chamados)
    {
        $this->chamados = $chamados;
        $this->middleware('auth');
    }

    /**
     * Show the chamados.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $setoresList = User::distinct()->pluck('sector');

        $query = Chamados::with('createdByUser');

        $setorAtual = $request->input('sector');

        if (!empty($setorAtual)) {
            $query->whereHas('createdByUser', function ($query) use ($setorAtual) {
                $query->where('sector', $setorAtual);
            });
        }

        $status = 0; //para colocar o botão de adicionar chamado, usarei o mesmo blade para consutlar chamados antigos, status 0 para ter o botão de adicionar


        $chamadosList = $query
            ->where('status', 'pending')
            ->with('createdByUser')
            ->get();

        $chamadosList = $chamadosList->map(function ($item) {
            $item->tempoDecorrido = Carbon::parse($item->created_at)->diffForHumans();
            return $item;
        });

        //DD($chamadosList);

        return view('chamados.index', compact('chamadosList', 'setoresList', 'setorAtual', 'status'));
    }

    public function going(Request $request)
    {
        $setoresList = User::distinct()->pluck('sector');

        $query = Chamados::with('createdByUser');

        $setorAtual = $request->input('sector');

        if (!empty($setorAtual)) {
            $query->whereHas('createdByUser', function ($query) use ($setorAtual) {
                $query->where('sector', $setorAtual);
            });
        }

        $status = 1; // para saber que é o blade onde mostra os pendentes

        $chamadosList = $query
            ->where('status', 'on_going')
            ->with('createdByUser')
            ->get();

        $chamadosList = $chamadosList->map(function ($item) {
            $item->tempoDecorrido = Carbon::parse($item->created_at)->diffForHumans();
            return $item;
        });

        return view('chamados.index', compact('chamadosList', 'setoresList', 'setorAtual', 'status'));
    }

    public function log(Request $request)
    {
        $setoresList = User::distinct()->pluck('sector');

        $query = Chamados::with('createdByUser');

        $setorAtual = $request->input('sector');

        if (!empty($setorAtual)) {
            $query->whereHas('createdByUser', function ($query) use ($setorAtual) {
                $query->where('sector', $setorAtual);
            });
        }

        $status = 2; // dos já terminados

        $chamadosList = $query
            ->where('status', 'done')
            ->with('createdByUser')
            ->get();

        $chamadosList = $chamadosList->map(function ($item) {
            $item->tempoDecorrido = Carbon::parse($item->created_at)->diffForHumans();
            $item->tempoFinalizado = Carbon::parse($item->done_at)->diffForHumans();
            return $item;
        });

        return view('chamados.index', compact('chamadosList', 'setoresList', 'setorAtual', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chamados.create');
    }

    public function atenderChamado($id)
    {
        $chamado = Chamados::findOrFail($id);

        if (isset($chamado)) {
            // Se chamado não é nulo e existe
            if ($chamado->status == 'on_going') {
                // Testa se já foi chamado
                // Armazena a mensagem de erro na sessão
                session()->flash('error', 'Esse chamado já foi atendido.');
                // Redireciona o usuário de volta para a página anterior
                return redirect()->back();
            }
        }

        $chamado->status = 'on_going';
        //$chamado->done_at = now()->format('Y-m-d H:i:s');
        $chamado->save();

        // Armazena a mensagem de sucesso na sessão
        session()->flash('success', 'Chamado atendido com sucesso.');

        // Redireciona o usuário de volta para a página anterior
        return redirect()->back();
    }

    public function finalizarChamado($id)
    {
        $chamado = Chamados::findOrFail($id);

        if (isset($chamado)) {
            // Se chamado não é nulo e existe
            if ($chamado->status == 'done') {
                // Testa se já foi chamado
                // Armazena a mensagem de erro na sessão
                session()->flash('error', 'Esse chamado já foi finalizado.');
                // Redireciona o usuário de volta para a página anterior
                return redirect()->back();
            }
        }

        $chamado->done_by = Auth::id();
        $chamado->status = 'done';
        $chamado->done_at = now()->format('Y-m-d H:i:s');
        $chamado->save();

        // Armazena a mensagem de sucesso na sessão
        session()->flash('success', 'Chamado atendido com sucesso.');

        // Redireciona o usuário de volta para a página anterior
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();
        $dataForm['created_by'] = auth()->user()->id;

        $chamados = $this->chamados->create($dataForm);
        $chamados->save();

        if ($chamados) {
            return redirect('/chamados')->with('success', 'Chamado criado com sucesso!');
        } else {
            return redirect('/home')->with('fail', 'Falha ao criar chamado!');
        }
    }
}

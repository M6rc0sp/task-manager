<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chamados;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtenha a lista de todos os usuários com seus setores
        $users = User::get();

        // Inicialize um array vazio para armazenar as contagens de chamados
        $chamadosAtendidosPorSetor = [];
        $chamadosCriadosPorSetor = [];
        $chamadosAtendidosPorUsuario = [];
        $chamadosCriadosPorUsuario = [];

        // Para cada usuário, conte os chamados associados a ele e adicione-os ao array de contagem de chamados
        foreach ($users as $user) {
            $chamadosAtendidosPorSetor[$user->sector][] = Chamados::where('done_by', $user->id)->count();
            $chamadosCriadosPorSetor[$user->sector][] = Chamados::where('created_by', $user->id)->where('status', 'on_going')->count(); // Criados e não atendidos
            $chamadosAtendidosPorUsuario[$user->name][] = Chamados::where('done_by', $user->id)->count();
            $chamadosCriadosPorUsuario[$user->name][] = Chamados::where('created_by', $user->id)->count();
        }

        // Envie os dados para a view
        return view('home', compact('chamadosCriadosPorSetor', 'chamadosAtendidosPorSetor', 'chamadosAtendidosPorUsuario', 'chamadosCriadosPorUsuario'));
    }
}

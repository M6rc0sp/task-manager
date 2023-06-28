<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $users = User::orderBy('name')->get();
        
        $users = $users->map(function ($user) {
            $user->total_chamados = $user->chamados->count();
            $user->chamados_ativos = $user->chamados->where('done', false)->count();
            $user->chamados_atendidos = $user->chamados->where('done_by', $user->id)->count();
            return $user;
        });

        // Envie os dados para a view
        return view('usuarios.index', compact('users'));
    }
}

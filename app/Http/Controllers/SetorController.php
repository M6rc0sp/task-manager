<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;

class SetorController extends Controller
{

    public function list()
    {
        $setores = Setor::pluck('name', 'id');
        return response()->json($setores);
    }

    public function index()
    {
        $setores = Setor::all();
        return view('setores.index', compact('setores'));
    }

    public function create()
    {
        return view('setores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Setor::create($request->all());

        return redirect()->route('setores.index')->with('success', 'Setor criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setor = Setor::findOrFail($id);
        $setor->delete();

        return redirect()->route('setores.index')->with('success', 'Setor excluído com sucesso.');
    }
}

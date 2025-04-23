<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoContato;

class TipoContatosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipocontatos = TipoContato::all();
        return view('tipoContatos.index', compact('tipocontatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipocontatos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:80',
        ]);

        $tipocontato = new TipoContato();
        $tipocontato->nome = $request->input('nome');
        $tipocontato->descricao = $request->input('descricao');
        if ($tipocontato->save()) {
            return redirect()->route('tipocontatos.index')->with('success', 'Tipo de contato criado com sucesso!');
        }
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
    public function edit($id)
    {
        $tipocontato = TipoContato::findOrFail($id);
        return view('tipoContatos.edit', compact('tipocontato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:80',
        ]);

        $tipocontato = TipoContato::findOrFail($id);
        $tipocontato->nome = $request->input('nome');
        $tipocontato->descricao = $request->input('descricao');
        if ($tipocontato->save()) {
            return redirect()->route('tipocontatos.index')->with('success', 'Tipo de contato atualizado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipocontato = TipoContato::findOrFail($id);

        if ($tipocontato->delete()) {
            return redirect()->route('tipocontatos.index')->with('success', 'Tipo de contato excluído com sucesso!');
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use App\Models\TipoContato;

class ContatosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contatos = Contato::all();
        $q = null;

        return view('contatos.index', compact('contatos','q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipocontatos = TipoContato::all();
        return view('contatos.create', compact('tipocontatos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ]);

        $contato = new Contato();
        $contato->nome = $request->input('nome');
        $contato->email = $request->input('email');
        $contato->telefone = $request->input('telefone');
        $contato->cidade = $request->input('cidade');
        $contato->estado = $request->input('estado');
        $contato->tipo_contato_id = $request->input('tipo_contato_id');
        if ($contato->save()) {
            return redirect()->route('contatos.index')->with('success', 'Contato criado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contato = Contato::findOrFail($id);

        return view('contatos.show', compact('contato'));
    }

    public function search(Request $request)
    {
        $q=$request->input('q');
        $contatos = Contato::where('nome', 'like', '%' . $request->input('q') . '%')
            ->orWhere('email', 'like', '%' . $request->input('q') . '%')
            ->get();

        return view('contatos.index', compact('contatos', 'q'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contato = Contato::findOrFail($id);
        $tipocontatos = TipoContato::all();
        return view('contatos.edit', compact('contato', 'tipocontatos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ]);

        $contato = Contato::findOrFail($id);
        $contato->nome = $request->input('nome');
        $contato->email = $request->input('email');
        $contato->telefone = $request->input('telefone');
        $contato->cidade = $request->input('cidade');
        $contato->estado = $request->input('estado');
        $contato->tipo_contato_id = $request->input('tipo_contato_id');
        if ($contato->save()) {
            return redirect()->route('contatos.index')->with('success', 'Contato alterado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contato = Contato::FindorFail($id);
        if ($contato->delete()) {
            return redirect()->route("contatos.index")->with('success', 'Contato excluído');
        }
    }
}
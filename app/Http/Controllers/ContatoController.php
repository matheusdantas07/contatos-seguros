<?php

namespace App\Http\Controllers;

use App\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contatos = Auth::user()->contatos;

        return view('contato.index', compact('contatos'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contato.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        //  $usuario = Auth::user();
        // Contato::create([
        //     'nome' => $request->nome,
        //     'telefone' => $request->telefone,
        //     'user_id' => $usuario->id
        // ]);
        try {
            Auth::user()->contatos()->create($request->all());
            flash('salvo com sucesso')->success();
        } catch (\exception $e){
            flash('ocorreu um erro ao salvar')->error();

            return back()->withInput();
        }

        

        return redirect()->route('contatos.index');
    

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function show(Contato $contato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contato $contato)
    {
        return view('contato.form', compact('contato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contato $contato)
    {
       
        try {
            $contato->update($request->all());
            flash('atualizado com sucesso')->success();
        } catch (\exception $e){
            flash('ocorreu um erro ao atualizar')->error();

            return back()->withInput();
        }

        

        return redirect()->route('contatos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contato $contato)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planos = Plano::all();
        dd($planos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plano = new Plano();
        $plano->nome = $request->nome;
        $plano->convenio_id = $request->convenio_id;
        $plano->save();

        //retorne sucesso para o ajax
        return response()->json([
            'success' => 'Plano adicionado com sucesso!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Plano $plano)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Plano $plano)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados do convênio
        $request->validate([
            'registro' => 'required',
            'nome' => 'required',
            'carencia' => 'required',
        ]);

        $convenio = Convenio::findOrFail($id);
        $convenio->registro = $request->registro;
        $convenio->nome = $request->nome;
        $convenio->carencia = $request->carencia;
        $convenio->save();

        // Atualizar os planos existentes
        $planoNomes = $request->plano_nome;
        if ($planoNomes && is_array($planoNomes)) {
            foreach ($planoNomes as $planoId => $planoNome) {
                if (! empty($planoNome)) {
                    $plano = Plano::findOrFail($planoId);
                    $plano->nome = $planoNome;
                    $plano->save();
                }
            }
        }

        // Redirecionar de volta à página de edição
        return redirect()
            ->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plano = Plano::findOrFail($id);
        $plano->delete();

        //retorne sucesso para o ajax
        return response()->json([
            'success' => 'Plano removido com sucesso!',
        ]);

    }
}

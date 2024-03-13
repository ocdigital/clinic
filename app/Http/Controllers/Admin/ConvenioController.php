<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Convenio;
use App\Models\Plano;
use App\Models\User;
use Illuminate\Http\Request;

class ConvenioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convenios = Convenio::paginate();

        return view('admin.convenios.index', compact('convenios'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.convenios.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConvenioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validação dos dados do convênio
        $request->validate([
            'registro' => 'required',
            'nome' => 'required',
            'carencia' => 'required',
        ]);

        $convenio = new Convenio;
        $convenio->registro = $request->registro;
        $convenio->nome = $request->nome;
        $convenio->carencia = $request->carencia;
        $convenio->save();

        $user = User::find(1);
        dispatch(new SendEmailJob($user));

        // Salvar os planos associados ao convênio
        $planoNomes = $request->plano_nome;
        if ($planoNomes && is_array($planoNomes)) {
            foreach ($planoNomes as $planoNome) {
                if (! empty($planoNome)) {
                    $plano = new Plano;
                    $plano->nome = $planoNome;
                    $plano->convenio_id = $convenio->id;
                    $plano->save();
                }
            }
        }

        return redirect()->route('admin.convenios.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Convenio $convenio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Convenio  $convenio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $convenio = Convenio::find($id);
        $planos = $convenio->planos;

        return view('admin.convenios.createOrUpdate', compact('convenio', 'planos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConvenioRequest  $request
     * @param  \App\Models\Convenio  $convenio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validação dos dados codigo , nome
        $request->validate([
            'registro' => 'required',
            'nome' => 'required',
            'carencia' => 'required',
        ]);

        $convenio = Convenio::find($id);
        $convenio->registro = $request->registro;
        $convenio->nome = $request->nome;
        $convenio->carencia = $request->carencia;
        $convenio->save();

        return redirect()->route('admin.convenios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Convenio $convenio)
    {
        try {
            $convenio->delete();

            return redirect()->route('admin.convenios.index');
        } catch (\Exception $e) {
            return redirect()->route('admin.convenios.index')->with('message', 'Não foi possível deletar o convenio, pois existem planos associados a ele!');
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $pacientes=Paciente::all();
        return view('pacientes.index',compact('pacientes'));
    }

    //retornar todas os pacientes para um endpoint da API
    public function apiIndex()
    {
        $pacientes=Paciente::all();
        return response()->json($pacientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //criar um novo paciente
    public function store(Request $request)
    {
        $paciente = new Paciente;
        $paciente->nome = $request->nome;
        $paciente->data_nascimento = $request->data_nascimento;
        $paciente->sexo = $request->sexo;
        $paciente->endereco = $request->endereco;
        $paciente->telefone = $request->telefone;
        $paciente->email = $request->email;
        $paciente->save();

        return response()->json($paciente);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {                
            return view('pacientes.show',compact('paciente'));
    }

    //retornar um paciente específico para um endpoint da API
    public function apiShow($id)
    {
        $paciente = Paciente::find($id);          
        if(!$paciente){
            return response()->json(['message' => 'Paciente não encontrado'], 404);
        }  
        return response()->json($paciente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */

    //aponte para a view de edição de pacientes createOrUpdate
    public function edit($id)
    {            
        $paciente = Paciente::find($id);

        return view('pacientes.createOrUpdate',compact('paciente'));    

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $paciente = Paciente::find($id);
            
            $paciente->nome = $request->nome;
            $paciente->data_nascimento = $request->data_nascimento;
            $paciente->sexo = $request->sexo;
            $paciente->endereco = $request->endereco;
            $paciente->telefone = $request->telefone;
            $paciente->email = $request->email;
            $paciente->save();
    
            return response()->json($paciente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {           
        $paciente = Paciente::find($id);
        $paciente->delete();    
        return response()->json(['message' => 'Paciente deletado com sucesso']);
    }
}

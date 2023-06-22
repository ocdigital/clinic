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

    public function index(Request $request)
    {
        $query = Paciente::query();

        // Filtrar por nome
        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->input('nome') . '%');
        }
    
        // Filtrar por sexo
        if ($request->filled('sexo')) {
            $query->where('sexo', $request->input('sexo'));
        }
    
        // Filtrar por email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
    
        // Ordenar os resultados
        $orderColumn = $request->input('order_by', 'nome'); // Coluna padrão para ordenação é 'nome'
        $orderDirection = $request->input('order_direction', 'asc'); // Direção padrão é ascendente
    
        $query->orderBy($orderColumn, $orderDirection);
    
        $pacientes = $query->paginate(10);

        $message = $request->session()->get('message');

        return view('pacientes.index', compact('pacientes', 'message'));
    }

    //retornar todas os pacientes para um endpoint da API
    public function apiIndex()
    {

        $pacientes=Paciente::paginate(2);

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

    //atualizar um paciente e retroceder para a view de listagem de pacientes
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

            // Definir a mensagem de sucesso
    $message = 'Paciente atualizado com sucesso';

    return redirect()->route('pacientes.index')->with('message', $message);
    
    }

    //update para api  
    public function apiUpdate(Request $request, $id)
    {
        $paciente = Paciente::find($id);
        if(!$paciente){
            return response()->json(['message' => 'Paciente não encontrado'], 404);
        }  
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

     //retornar para listagem de pacientes
    public function destroy($id)
    {           
        $paciente = Paciente::find($id);
        $paciente->delete();    

        return redirect()->route('pacientes.index')->with('message','Paciente deletado com sucesso');
    }

    //deletar um paciente e retroceder para a view de listagem de pacientes
    public function apiDestroy($id)
    {
        $paciente = Paciente::find($id);
        if(!$paciente){
            return response()->json(['message' => 'Paciente não encontrado'], 404);
        }  
        $paciente->delete();    
        return response()->json(['message' => 'Paciente deletado com sucesso']);
    }

    //criar uma api para buscar um paciente utilizando o typesense
    public function apiSearch($nome)
    {
        $paciente = Paciente::search($nome)->get();

        return response()->json($paciente);
    }
}
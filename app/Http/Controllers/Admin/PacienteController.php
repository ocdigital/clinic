<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Convenio;
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
            $query->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        // Filtrar por sexo
        if ($request->filled('sexo')) {
            $query->where('sexo', $request->input('sexo'));
        }

        // Filtrar por email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%'.$request->input('email').'%');
        }

        // Ordenar os resultados
        $orderColumn = $request->input('order_by', 'nome'); // Coluna padrão para ordenação é 'nome'
        $orderDirection = $request->input('order_direction', 'asc'); // Direção padrão é ascendente

        $query->orderBy($orderColumn, $orderDirection);

        $pacientes = $query->paginate(10);

        $message = $request->session()->get('message');

        return view('admin.pacientes.index', compact('pacientes', 'message'));
    }

    public function autocomplete(Request $request)
    {
        $data = Paciente::select('nome as value', 'id')
            ->where('nome', 'LIKE', '%'.$request->get('search').'%')
            ->get();

        return response()->json($data);
    }

    // //retornar todas os pacientes para um endpoint da API
    public function apiIndex(Request $request)
    {
        $termoPesquisa = $request->input('termo_pesquisa');

        $query = Paciente::query();

        if ($termoPesquisa) {
            $query->where('nome', 'LIKE', '%'.$termoPesquisa.'%');
        }

        $pacientes = $query->with('convenio')->get();

        $select2Data = [];
        foreach ($pacientes as $paciente) {
            $select2Data[] = [
                'id' => $paciente->id,
                'text' => $paciente->nome,
                'convenio_nome' => optional($paciente->convenio)->nome,
                'telefone' => $paciente->telefone,
            ];
        }

        return response()->json(['results' => $select2Data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $convenios = Convenio::all();

        return view('admin.pacientes.createOrUpdate', compact('convenios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    //criar um novo paciente
    public function store(Request $request)
    {
        //validação dos dados
        $request->validate([
            'nome' => 'required',
            'data_nascimento' => 'required',
            'sexo' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
            'email' => 'required',
        ]);

        $paciente = new Paciente;
        $paciente->nome = $request->nome;
        $paciente->data_nascimento = $request->data_nascimento;
        $paciente->sexo = $request->sexo;
        $paciente->endereco = $request->endereco;
        $paciente->telefone = $request->telefone;
        $paciente->email = $request->email;
        $paciente->convenio_id = $request->convenio_id;
        $paciente->save();

        return redirect()->route('admin.pacientes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd('show');
        $paciente = Paciente::find($id);

        return view('admin.pacientes.createOrUpdate', compact('paciente'));
    }

    // //retornar um paciente específico para um endpoint da API
    // public function apiShow($id)
    // {
    //     $paciente = Paciente::find($id);
    //     if(!$paciente){
    //         return response()->json(['message' => 'Paciente não encontrado'], 404);
    //     }
    //     return response()->json($paciente);
    // }

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
        $convenios = Convenio::all();

        dd($paciente);

        return view('admin.pacientes.createOrUpdate', compact('paciente', 'convenios'));

    }

    /**
     * Update the specified resource in storage.
     *
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
        $paciente->convenio_id = $request->convenio_id;
        $paciente->save();

        return redirect()->route('admin.pacientes.index');

    }

    // //update para api
    // public function apiUpdate(Request $request, $id)
    // {
    //     $paciente = Paciente::find($id);
    //     if(!$paciente){
    //         return response()->json(['message' => 'Paciente não encontrado'], 404);
    //     }
    //     $paciente->nome = $request->nome;
    //     $paciente->data_nascimento = $request->data_nascimento;
    //     $paciente->sexo = $request->sexo;
    //     $paciente->endereco = $request->endereco;
    //     $paciente->telefone = $request->telefone;
    //     $paciente->email = $request->email;
    //     $paciente->save();

    //     return response()->json($paciente);
    // }

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

        return redirect()->route('admin.pacientes.index');
    }

    // //deletar um paciente e retroceder para a view de listagem de pacientes
    // public function apiDestroy($id)
    // {
    //     $paciente = Paciente::find($id);
    //     if(!$paciente){
    //         return response()->json(['message' => 'Paciente não encontrado'], 404);
    //     }
    //     $paciente->delete();
    //     return response()->json(['message' => 'Paciente deletado com sucesso']);
    // }

    //     //criar uma api para buscar um paciente utilizando o typesense
    //     public function apiSearch($nome)
    //     {
    //         $paciente = Paciente::search($nome)->get();

    //         return response()->json($paciente);
    //     }
    //
}

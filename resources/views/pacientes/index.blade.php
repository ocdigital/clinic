<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
  <div class="container">
    <h1>Lista de Pacientes</h1>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Data de Nascimento</th>
          <th>Sexo</th>
          <th>Endereço</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pacientes as $paciente)
          <tr>
            <td>{{ $paciente->nome }}</td>
            <td>{{ $paciente->data_nascimento }}</td>
            <td>{{ $paciente->sexo }}</td>
            <td>{{ $paciente->endereco }}</td>
            <td>{{ $paciente->telefone }}</td>
            <td>{{ $paciente->email }}</td>
            <td>
              <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-primary">Atualizar</a>
              <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
            </div>
        </div>
    </div>  
</x-app-layout>

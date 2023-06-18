<x-app-layout>

  <!-- Arquivos CSS do SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

<!-- Arquivos JavaScript do SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

@if (isset($message))
<div class="bg-green-200 text-green-800 px-4 py-2 mb-4">{{ $message }}</div>
@endif
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
  
      <table class="min-w-full bg-white border border-gray-200">
      <thead>
        <tr>
          <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Nome</th>
          <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Data de Nascimento</th>
          <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Sexo</th>
          <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Telefone</th>
          <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Email</th>
          <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pacientes as $paciente)
          <tr>
            <td class="py-3 px-4">{{ $paciente->nome }}</td>
            <td class="py-3 px-4">{{ $paciente->data_nascimento }}</td>
            <td class="py-3 px-4">{{ $paciente->sexo }}</td>
            <td class="py-3 px-4">{{ $paciente->telefone }}</td>
            <td class="py-3 px-4">{{ $paciente->email }}</td>
            <td class="py-3 px-4">
              <div class="flex">
                  <a href="{{ route('pacientes.edit', $paciente->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                  <form id="deleteForm{{ $paciente->id }}" action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="confirmDelete('{{ $paciente->id }}')">Deletar</button>
                </form>                
              </div>
          </td>          
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    function confirmDelete(pacienteId) {
        Swal.fire({
            title: 'Tem certeza?',
            text: 'Esta ação não pode ser desfeita!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, deletar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Obter o formulário pelo ID
                const form = document.getElementById('deleteForm' + pacienteId);

                // Enviar o formulário de exclusão
                form.submit();
            }
        });
    }
</script>



               
  
</x-app-layout>

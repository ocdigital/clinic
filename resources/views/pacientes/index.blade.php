<x-app-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><!-- content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                  <div class="flex justify-between mb-4 mt-4">
                    <form action="{{ route('pacientes.index') }}" method="GET" class="flex">
                        <div class="mr-2">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" value="{{ request()->input('nome') }}"
                                class="px-4 py-2 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300">
                        </div>
                        <div class="mr-2">
                            <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                            <select name="sexo" id="sexo"
                                class="px-4 py-2 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300">
                                <option value="">Todos</option>
                                <option value="Masculino" {{ request()->input('sexo') === 'Masculino' ? 'selected' : '' }}>Masculino
                                </option>
                                <option value="Feminino" {{ request()->input('sexo') === 'Feminino' ? 'selected' : '' }}>Feminino
                                </option>
                            </select>
                        </div>
                        <div class="mr-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ request()->input('email') }}"
                                class="px-4 py-2 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300">
                        </div>
                      
                            <button type="submit"
                                class="px-4  bg-indigo-500 hover:bg-indigo-600 text-white font-bold rounded">Filtrar</button>
      
                    </form>
                
                    <a href="{{ route('pacientes.create') }}"
                        class="px-4 py-2 bg-green-500 hover:bg-green-300 rounded-md self-center">Create</a>
                </div>
                
                    <div class="mb-6">
                       <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Nome</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Data de
                                        Nascimento</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Sexo</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Telefone</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Email</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pacientes as $paciente)
                                    <tr>
                                        <td class="py-3 px-4">{{ $paciente->nome }}</td>
                                        <td class="py-3 px-4">{{ $paciente->data_nascimento }}</td>
                                        <td class="py-3 px-4">{{ $paciente->sexo }}</td>
                                        <td class="py-3 px-4">{{ $paciente->telefone }}</td>
                                        <td class="py-3 px-4">{{ $paciente->email }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex">
                                                <a href="{{ route('pacientes.edit', $paciente->id) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                                                <form id="deleteForm{{ $paciente->id }}"
                                                    action="{{ route('pacientes.destroy', $paciente->id) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                                        onclick="confirmDelete('{{ $paciente->id }}')">Deletar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $pacientes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
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

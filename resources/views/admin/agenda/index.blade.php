<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">{{ session('message') }}</strong>
                    </div>
                @endif
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between mb-4 mt-4">
                        <a href="{{ route('admin.agendas.create') }}"
                            class="px-4 py-2 bg-green-500 hover:bg-green-300 rounded-md self-center">Create</a>
                    </div>

                    <div class="mb-6">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Registro</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Nome</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Carencia</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600 justify-end">
                                        Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendas as $agenda)
                                    <tr>
                                        <td class="py-3 px-4">{{ $agenda->registro }}</td>
                                        <td class="py-3 px-4">{{ $agenda->nome }}</td>
                                        <td class="py-3 px-4">{{ $agenda->carencia }}</td>

                                        <td class="py-3 px-4">
                                            <div class="flex justify-end ">
                                                <a href="{{ route('admin.agendas.edit', $agenda->id) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                                                    <button type="button" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" onclick="openDeleteModal('{{ $agenda->id }}')">Deletar</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $agendas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-admin-layout>

<!-- Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white w-1/3 p-6 rounded shadow-lg">
        <h2 class="text-xl font-bold mb-4">Confirmar exclusão</h2>
        <p class="mb-4">Tem certeza que deseja deletar?</p>
        <div class="flex justify-end">
            <button class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2"
                onclick="closeDeleteModal()">Cancelar</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md">Deletar</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(agendaId) {
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = "{{ route('admin.agendas.destroy', '') }}" + "/" + agendaId;
        deleteModal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.classList.add('hidden');
    }
</script>

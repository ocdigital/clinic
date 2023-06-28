<x-app-layout>
    <div class="mx-auto px-4 sm:px-6 lg:px-12">
        @if (isset($message))
        <div class="bg-green-200 text-green-800 px-4 py-2 mb-4">{{ $message }}</div>
        @endif
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Nome</th>
                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Email</th>
                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Role</th>
                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-3 px-4">{{ $user->name }}</td>
                    <td class="py-3 px-4">{{ $user->email }}</td>
                    <td class="py-3 px-4">
                        @foreach($user->roles as $role)
                            {{ $role->name }}
                            @if(!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <div class="flex">
                            <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                            <form id="deleteForm{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="confirmDelete('{{ $user->id }}')">Deletar</button>
                            </form>                
                        </div>
                    </td>           
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

<script>
    function confirmDelete(userId) {
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
                const form = document.getElementById('deleteForm' + userId);

                // Enviar o formulário de exclusão
                form.submit();
            }
        });
    }
</script>

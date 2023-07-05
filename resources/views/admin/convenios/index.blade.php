<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><!-- content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">{{ session('message') }}</strong>
                </div>
            @endif
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                  <div class="flex justify-between mb-4 mt-4">                
                    <a href="{{ route('admin.convenios.create') }}"
                        class="px-4 py-2 bg-green-500 hover:bg-green-300 rounded-md self-center">Create</a>
                </div>
                
                    <div class="mb-6">
                       <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Registro</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Nome</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600">Carencia</th>
                                    <th class="py-3 px-4 bg-gray-100 font-semibold text-sm text-gray-600 justify-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($convenios as $convenio)
                                    <tr>
                                        <td class="py-3 px-4">{{ $convenio->registro}}</td>
                                        <td class="py-3 px-4">{{ $convenio->nome }}</td>
                                        <td class="py-3 px-4">{{ $convenio->carencia }}</td>

                                        <td class="py-3 px-4">
                                            <div class="flex justify-end ">
                                                <a href="{{ route('admin.convenios.edit', $convenio->id) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                                                <form id="deleteForm{{ $convenio->id }}"
                                                    action="{{ route('admin.convenios.destroy', $convenio->id) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                                        onclick="confirmDelete('{{ $convenio->id }}')">Deletar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $convenios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </x-admin-layout>

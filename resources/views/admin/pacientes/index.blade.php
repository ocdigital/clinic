<x-admin-layout>
    <div class="py-2 w-full">
        <div class="ml-2 mr-2">
            <div class="bg-white overflow-hidden shadow-sm p-2">
                <div class="flex flex-col">
                    <form method="get" action="{{ route('admin.pacientes.index') }}" class="p-4">
                        <div class="grid grid-cols-4  justify-end">
                        <div>
                            <input type="text" name="nome" placeholder="Nome" value="{{ request('nome') }}" />
                        </div>
                        <div>
                            <input type="text" name="email" placeholder="Email" value="{{ request('email') }}" />
                        </div>

                        <div>
                            <select name="sexo" label="Sexo">
                                <option value="" selected>Selecione</option>
                                <option value="masculino" {{ request('sexo') === 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="feminino" {{ request('sexo') === 'feminino' ? 'selected' : '' }}>Feminino</option>
                            </select>
                        </div>
                        <div class="flex items-end space-x-4">
                            <x-primary-button type="submit">Filtrar</x-primary-button>
                            <x-success-button class="px-4 py-2 bg-green-500 hover:bg-green-300 text-white rounded-md"
                                href="{{ route('admin.pacientes.create') }}" x-data=""
                                x-on:click.prevent="window.location.href='{{ route('admin.pacientes.create') }}'">
                                {{ __('Novo') }}
                            </x-success-button>

                        </div>
                    </div>

                    </form>

                                <table class="min-w-full divide-y divide-gray-200">
                                   <thead class="bg-sky-900 text-white">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                Nome</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                Nascimento</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                Sexo</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                Telefone</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">
                                                Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($pacientes as $paciente)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        {{ $paciente->nome }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        {{ $paciente->data_nascimento }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        {{ $paciente->sexo }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        {{ $paciente->telefone }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex justify-end">
                                                        <div class="flex space-x-2">
                                                            <x-secondary-button
                                                                href="{{ route('admin.pacientes.edit', $paciente->id) }}"
                                                                x-data=""
                                                                x-on:click.prevent="window.location.href='{{ route('admin.pacientes.edit', $paciente->id) }}'">{{ __('Editar') }}</x-secondary-button>

                                                            {{-- <x-danger-button x-data=""
                                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-paciente-deletion')">{{ __('Deletar') }}
                                                            </x-danger-button> --}}

                                                             <form method="post" action="{{ route('admin.pacientes.destroy', $paciente->id) }}"
                                                                onsubmit="return confirm('Deseja realmente remover esse paciente?');">
                                                                @csrf
                                                                @method('delete')
                                                                 <x-danger-button x-data="">
                                                                    {{ __('Deletar') }}
                                                                </x-danger-button>
                                                             </form>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                             {{ $pacientes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

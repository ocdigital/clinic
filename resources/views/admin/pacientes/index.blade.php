<x-admin-layout>
    <div class="py-2 w-full">
        <div class="ml-2 mr-2">
            <div class="bg-white overflow-hidden shadow-sm  p-2">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="flex justify-end p-2">
                                <x-success-button class="px-4 py-2 bg-green-500 hover:bg-green-300 text-white rounded-md"
                                    href="{{ route('admin.pacientes.create') }}" x-data=""
                                    x-on:click.prevent="window.location.href='{{ route('admin.pacientes.create') }}'">
                                    {{ __('Novo') }}
                                    </x-primary-button>
                            </div>
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                Email</th>
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
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        {{ $paciente->email }}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

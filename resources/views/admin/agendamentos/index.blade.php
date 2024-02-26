<x-admin-layout>
    <div class="py-2 w-full">
        <div class="ml-2 mr-2">
            <div class="bg-white overflow-hidden shadow-sm  p-2">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">

                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                   <thead class="bg-sky-900 text-white">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                Nome</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                Inicio</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                                Final</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($agendamentos as $agendamento)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        {{ $agendamento->title }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        {{ $agendamento->start }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        {{ $agendamento->end }}
                                                    </div>
                                                </td>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                             {{ $agendamentos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

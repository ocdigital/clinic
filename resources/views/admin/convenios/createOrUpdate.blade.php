<x-admin-layout>
 <div class="py-2 w-full">
        <div class="ml-2 mr-2">
            <div class="w-full">
                        <div class="bg-white shadow-md">
                            <div class="bg-gray-200 text-gray-800 px-6 py-4">
                                {{ isset($convenio) ? 'Editar convenio' : 'Criar convenio' }}
                            </div>

                            <div class="p-6">
                                @if (isset($convenio))
                                    <form action="{{ route('admin.convenios.update', $convenio->id) }}" method="POST">
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('admin.convenios.store') }}" method="POST">
                                @endif
                                @csrf
                                <!-- Dados Principais -->
                                <div class="mb-4">
                                    <h2 class="text-xl font-semibold mb-2">Dados Principais</h2>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="registro" class="block mb-2">Registro:</label>
                                            <input type="text" name="registro" id="registro"
                                                class="w-full px-4 py-2 border rounded @error('registro') border-red-500 @enderror"
                                                value="{{ isset($convenio) ? $convenio->registro : '' }}">
                                            @error('registro')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="nome" class="block mb-2">Nome:</label>
                                            <input type="text" name="nome" id="nome"
                                                class="w-full px-4 py-2 border rounded @error('nome') border-red-500 @enderror"
                                                value="{{ isset($convenio) ? $convenio->nome : '' }}">
                                            @error('nome')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--campo carencia-->
                                        <div>
                                            <label for="carencia" class="block mb-2">Carencia:</label>
                                            <input type="text" name="carencia" id="carencia"
                                                class="w-full px-4 py-2 border rounded @error('carencia') border-red-500 @enderror"
                                                value="{{ isset($convenio) ? $convenio->carencia : '' }}">
                                            @error('carencia')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!--exiba planos se for editar-->
                                        @if (isset($plano))
                                        <h2 class="text-xl font-semibold mb-2">Planos</h2>
                                        <ul id="planos-list">
                                            <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                                @foreach ($planos as $plano)
                                                    <li class="flex items-center justify-between">
                                                        <span>{{ $plano->nome }}</span>
                                                        <div class="flex">
                                                            <button type="button" onclick="deletarPlano({{ $plano->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Deletar</button>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </dl>
                                        </ul>


                                        <div class="flex items-center">
                                            <input type="text" name="novoPlano" id="novoPlano" class="w-full px-4 py-2 border rounded @error('novoPlano') border-red-500 @enderror">
                                            <input type="text" name="convenio_id" value="{{ $convenio->id }}" class="hidden">
                                            <button type="button" onclick="addPlano()" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Adicionar</button>
                                        </div>
                                        @endif

                                        <!-- aqui vai o form-->
                                    </div>
                                </div>

                                <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Salvar</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-admin-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function addPlano() {
        //Obtem o nome do novo plano do campo de texto
        var planoNome = $('input[name="novoPlano"]').val();
        var convenio_id = $('input[name="convenio_id"]').val();

        if (planoNome) {
            // Envia os dados do novo plano ao servidor via AJAX
            $.ajax({
                url: '{{ route('admin.planos.store') }}', // Substitua pela rota correta no seu código
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nome: planoNome,
                    convenio_id: convenio_id
                },
                success: function(response) {
                    if (response.success) {
                        // Se a operação for bem-sucedida, você pode atualizar a lista de planos na página ou executar outras ações necessárias
                        alert('Plano adicionado com sucesso!');
                        window.location.reload();
                    } else {
                        // Se ocorrer algum erro no servidor, exiba uma mensagem de erro ou tome outras medidas adequadas
                        alert('Erro ao adicionar o plano.');
                    }
                },
                error: function() {
                    // Se ocorrer algum erro na requisição AJAX, exiba uma mensagem de erro ou tome outras medidas adequadas
                    alert('Erro na requisição AJAX.');
                }
            });
        }
    }
    function deletarPlano(itemId) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (confirm('Tem certeza de que deseja excluir este item?')) {
        // Faça aqui a lógica para excluir o item via AJAX
        // Você pode usar a função fetch() ou o objeto XMLHttpRequest para enviar uma requisição AJAX para o servidor

        // Exemplo usando fetch():
        fetch('/admin/planos/' + itemId, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token
            }
        })
            .then(function(response) {
            // A requisição foi bem-sucedida?
            window.location.reload();
            })
            .catch(function(error) {
            // Houve um erro ao fazer a requisição AJAX
            console.log('Erro na requisição AJAX');
            });
        }
    }

</script>

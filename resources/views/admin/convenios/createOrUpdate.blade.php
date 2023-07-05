<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-center">
            <div class="w-3/4">
                <div class="bg-white shadow-md rounded-lg">
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

                                <!-- Planos -->
                                <div class="mb-4">
                                    <h2 class="text-xl font-semibold mb-2">Planos</h2>
                                    <div id="planos-container">
                                        <!-- Campos do plano -->
                                        @foreach ($planos as $plano)
                                            <div class="grid grid-cols-2 gap-4 mt-2">
                                                <div>
                                                    <label for="plano_nome" class="block mb-2">Nome do Plano:</label>
                                                    <input type="text" name="plano_nome[]"
                                                        class="w-full px-4 py-2 border rounded plano-nome-input"
                                                        value="{{ $plano->nome }}">
                                                </div>
                                                <div>
                                                    <button type="button" onclick="updatePlano({{ $plano->id }})"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Atualizar</button>
                                                    <button type="button" onclick="removePlano({{ $plano->id }})"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Remover</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" onclick="addPlano()"
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-2">Adicionar
                                        Plano</button>
                                </div>




                            </div>
                        </div>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function addPlano() {
            var planosContainer = document.getElementById('planos-container');

            // Criar div para os campos do plano
            var planoDiv = document.createElement('div');
            planoDiv.classList.add('grid', 'grid-cols-2', 'gap-4', 'mt-2');

            // Criar campo do nome do plano
            var nomeLabel = document.createElement('label');
            nomeLabel.setAttribute('for', 'plano_nome');
            nomeLabel.classList.add('block', 'mb-2');
            nomeLabel.textContent = 'Nome do Plano:';

            var nomeInput = document.createElement('input');
            nomeInput.setAttribute('type', 'text');
            nomeInput.setAttribute('name', 'plano_nome[]');
            nomeInput.setAttribute('id', 'plano_nome');
            nomeInput.classList.add('w-full', 'px-4', 'py-2', 'border', 'rounded');

            planoDiv.appendChild(nomeLabel);
            planoDiv.appendChild(nomeInput);

            planosContainer.appendChild(planoDiv);
        }

        // Função para enviar o plano ao servidor usando AJAX
        function enviarPlano(planoNome) {
            $.ajax({
                url: '{{ route('admin.planos.store') }}',
                method: 'POST',
                data: {
                    nome: planoNome,
                    convenio_id: {{ isset($convenio) ? $convenio->id : 'null' }},
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Lógica para atualizar a exibição dos planos na tela, se necessário
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Função para lidar com o envio do formulário
        $('form').submit(function(event) {
            event.preventDefault();

            var planos = $('input[name="plano_nome[]"]');
            planos.each(function() {
                var planoNome = $(this).val();

                if (planoNome !== '') {
                    enviarPlano(planoNome);
                }
            });

            // Submeter o formulário após o envio dos planos
            this.submit();
        });

        // Função para remover um plano
        function removePlano(planoId) {
            // Fazer uma requisição AJAX para a rota de remoção do plano
            axios.delete(`/admin/planos/${planoId}`)
                .then(response => {
                    console.log(response);
                    // Se a remoção for bem-sucedida, remover o plano da tela               
                    window.location.reload();
                })
                .catch(error => {
                    console.error(error);
                });
        }
        // Função para atualizar um plano
        function updatePlano(planoId) {
            // Recuperar o nome do plano atualizado
          
            const novoNomeInput = document.querySelector(`input[data-plano-id="${planoId}"]`);
            const novoNome = novoNomeInput ? novoNomeInput.value : '';
            if (novoNome !== null) {
                const nome = novoNome.value;

                // Fazer uma requisição AJAX para a rota de atualização do plano
                axios.put(`/planos/${planoId}`, {
                        nome: nome
                    })
                    .then(response => {
                        // Se a atualização for bem-sucedida, exibir uma mensagem de sucesso ou atualizar a página
                        console.log('Plano atualizado com sucesso!');
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    </script>
</x-admin-layout>

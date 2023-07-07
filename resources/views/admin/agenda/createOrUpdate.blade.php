<x-app-layout>
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-3/4">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="bg-gray-200 text-gray-800 px-6 py-4">
                        {{ isset($agenda) ? 'Editar agenda' : 'Criar agenda' }}</div>

                    <div class="p-6">
                        @if (isset($agenda))
                            <form action="{{ route('agendas.update', $agenda->id) }}" method="POST">
                                @method('PUT')
                            @else
                                <form action="{{ route('agendas.store') }}" method="POST">
                        @endif
                        @csrf
                        <!-- Dados Principais -->
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold mb-2">Dados Principais</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="nome" class="block mb-2">Nome:</label>
                                    <input type="text" name="nome" id="nome"
                                        class="w-full px-4 py-2 border rounded @error('nome') border-red-500 @enderror"
                                        value="{{ isset($agenda) ? $agenda->nome : '' }}">
                                    @error('nome')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="data_nascimento" class="block mb-2">Data de Nascimento:</label>
                                    <input type="date" name="data_nascimento" id="data_nascimento"
                                        class="w-full px-4 py-2 border rounded @error('data_nascimento') border-red-500 @enderror"
                                        value="{{ isset($agenda) ? $agenda->data_nascimento : '' }}">
                                    @error('data_nascimento')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--endereço-->
                                <div>
                                    <label for="endereco" class="block mb-2">Endereço:</label>
                                    <input type="text" name="endereco" id="endereco"
                                        class="w-full px-4 py-2 border rounded @error('endereco') border-red-500 @enderror"
                                        value="{{ isset($agenda) ? $agenda->endereco : '' }}">
                                    @error('endereco')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--telefone-->
                                <div>
                                    <label for="telefone" class="block mb-2">Telefone:</label>
                                    <input type="text" name="telefone" id="telefone"
                                        class="w-full px-4 py-2 border rounded @error('telefone') border-red-500 @enderror"
                                        value="{{ isset($agenda) ? $agenda->telefone : '' }}">
                                    @error('telefone')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- campo sexo -->
                                <div>
                                    <label for="sexo" class="block mb-2">Sexo:</label>
                                    <select name="sexo" id="sexo" class="w-full px-4 py-2 border rounded" onchange="showOthersexoField()">
                                        <option value="masculino" {{ isset($agenda) && $agenda->sexo === 'masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="feminino" {{ isset($agenda) && $agenda->sexo === 'feminino' ? 'selected' : '' }}>Feminino</option>
                                        <option value="outro" {{ isset($agenda) && $agenda->sexo === 'outro' ? 'selected' : '' }}>Outro</option>
                                    </select>
                                </div>
                                @if(isset($agenda) && $agenda->sexo === 'outro')
                                    <div id="othersexoField" style="display:block">
                                        <label for="othersexo" class="block mb-2">Outro Sexo:</label>
                                        <input type="text" name="othersexo" id="othersexo" class="w-full px-4 py-2 border rounded" value="{{ isset($agenda) ? $agenda->othersexo : '' }}">
                                    </div>
                                @else
                                    <div id="othersexoField" style="display:none">
                                        <label for="othersexo" class="block mb-2">Outro Sexo:</label>
                                        <input type="text" name="othersexo" id="othersexo" class="w-full px-4 py-2 border rounded">
                                    </div>
                                @endif
                                @error('othersexo')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror

                                <div>
                                    <label for="email" class="block mb-2">E-mail:</label>
                                    <input type="email" name="email" id="email"
                                        class="w-full px-4 py-2 border rounded @error('email') border-red-500 @enderror"
                                        value="{{ isset($agenda) ? $agenda->email : '' }}">
                                    @error('email')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>                        
                                <!-- Outros campos principais -->
                            </div>
                        </div>

                        <!-- Dados Complementares -->
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold mb-2">Dados Complementares</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="address" class="block mb-2">Endereço:</label>
                                    <input type="text" name="address" id="address"
                                        class="w-full px-4 py-2 border rounded @error('address') border-red-500 @enderror"
                                        value="{{ isset($agenda) ? $agenda->address : '' }}">
                                    @error('address')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="occupation" class="block mb-2">Profissão:</label>
                                    <input type="text" name="occupation" id="occupation"
                                        class="w-full px-4 py-2 border rounded @error('occupation') border-red-500 @enderror"
                                        value="{{ isset($agenda) ? $agenda->occupation : '' }}">
                                    @error('occupation')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="height" class="block mb-2">Altura:</label>
                                    <input type="text" name="height" id="height"
                                        class="w-full px-4 py-2 border rounded @error('height') border-red-500 @enderror"
                                        value="{{ isset($agenda) ? $agenda->height : '' }}">
                                    @error('height')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="weight" class="block mb-2">Peso:</label>
                                    <input type="text" name="weight" id="weight"
                                        class="w-full px-4 py-2 border rounded @error('weight') border-red-500 @enderror"
                                        value="{{ isset($agenda) ? $agenda->weight : '' }}">
                                    @error('weight')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Outros campos complementares -->
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

    <script>
        function showOthersexoField() {
            var sexoSelect = document.getElementById('sexo');
            var othersexoField = document.getElementById('othersexoField');
    
            if (sexoSelect.value === 'outro') {
                othersexoField.style.display = 'block';
            } else {
                othersexoField.style.display = 'none';
            }
        }
    </script>
</x-app-layout>

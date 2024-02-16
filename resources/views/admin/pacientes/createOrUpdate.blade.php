<x-admin-layout>
 <div class="py-2 w-full">
        <div class="ml-2 mr-2">
            <div class="w-full">
                <div class="bg-white shadow-md">
                   <div class="bg-sky-900 text-white px-6 py-4">
                        {{ isset($paciente) ? 'Editar Paciente' : 'Criar Paciente' }}</div>

                    <div class="p-6">
                        @if (isset($paciente))
                            <form action="{{ route('admin.pacientes.update', $paciente->id) }}" method="POST">
                                @method('PUT')
                            @else
                                <form action="{{ route('admin.pacientes.store') }}" method="POST">
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
                                        value="{{ old('nome', isset($paciente) ? $paciente->nome : '') }}">
                                    @error('nome')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="data_nascimento" class="block mb-2">Data de Nascimento:</label>
                                    <input type="date" name="data_nascimento" id="data_nascimento"
                                        class="w-full px-4 py-2 border rounded @error('data_nascimento') border-red-500 @enderror"
                                        value="{{ old('data_nascimento', isset($paciente) ? $paciente->data_nascimento : '') }}">
                                    @error('data_nascimento')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!--telefone-->
                                <div>
                                    <label for="telefone" class="block mb-2">Celular:</label>
                                    <input type="text" name="telefone" id="telefone"
                                        class="w-full px-4 py-2 border rounded @error('telefone') border-red-500 @enderror"
                                        value="{{ old('telefone', isset($paciente) ? $paciente->telefone : '') }}">
                                    @error('telefone')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- campo sexo -->
                                <div>
                                    <label for="sexo" class="block mb-2">Sexo:</label>
                                    <select name="sexo" id="sexo" class="w-full px-4 py-2 border rounded" onchange="showOthersexoField()">
                                        <option value="masculino" {{ isset($paciente) && $paciente->sexo === 'masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="feminino" {{ isset($paciente) && $paciente->sexo === 'feminino' ? 'selected' : '' }}>Feminino</option>
                                        <option value="outro" {{ isset($paciente) && $paciente->sexo === 'outro' ? 'selected' : '' }}>Outro</option>
                                    </select>
                                </div>
                                @if(isset($paciente) && $paciente->sexo === 'outro')
                                    <div id="othersexoField" style="display:block">
                                        <label for="othersexo" class="block mb-2">Outro Sexo:</label>
                                        <input type="text" name="othersexo" id="othersexo" class="w-full px-4 py-2 border rounded" value="{{ isset($paciente) ? $paciente->othersexo : '' }}">
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


                                <!-- Outros campos principais -->
                            </div>
                        </div>

                        <!-- Dados Complementares -->
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold mb-2">Dados Complementares</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="endereco" class="block mb-2">Endereço:</label>
                                    <input type="text" name="endereco" id="endereco"
                                        class="w-full px-4 py-2 border rounded @error('endereco') border-red-500 @enderror"
                                        value="{{ old('endereco', isset($paciente) ? $paciente->endereco : '') }}">
                                    @error('endereco')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block mb-2">E-mail:</label>
                                    <input type="email" name="email" id="email"
                                        class="w-full px-4 py-2 border rounded @error('email') border-red-500 @enderror"
                                        value="{{ old('email', isset($paciente) ? $paciente->email : '') }}">
                                    @error('email')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
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

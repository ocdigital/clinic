<x-admin-layout>
 <div class="py-2 w-full">
        <div class="ml-2 mr-2">
            <div class="w-full">
                <div class="bg-white shadow-md">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="bg-gray-200 text-gray-800 px-6 py-4">
                        {{ isset($user) ? 'Editar Usuário' : 'Criar Usuário' }}
                    </div>

                    <div class="p-6">
                        @if (isset($user))
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @method('PUT')
                            @else
                                <form action="{{ route('admin.users.store') }}" method="POST">
                        @endif
                        @csrf

                        <!-- Dados Principais -->
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold mb-2">Dados Principais</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <!-- campo tipo -->
                                <div>
                                    <label for="tipo" class="block mb-2">Tipo:</label>
                                    <select name="tipo" id="tipo" class="w-full px-4 py-2 border rounded"
                                        onchange="ocultaCampos()">
                                        <option value="medico" {{ old('tipo', isset($user) ? $user->tipo : '') == 'medico' ? 'selected' : '' }}>
                                            Médico</option>
                                        <option value="atendente" {{ old('tipo', isset($user) ? $user->tipo : '') == 'atendente' ? 'selected' : '' }}>
                                            Atendente</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="name" class="block mb-2">Nome:</label>
                                    <input type="text" name="name" id="name"
                                        class="w-full px-4 py-2 border rounded @error('name') border-red-500 @enderror"
                                        value="{{ old('name', isset($user) ? $user->name : '') }}">
                                    @error('name')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block mb-2">E-mail:</label>
                                    <input type="email" name="email" id="email"
                                        class="w-full px-4 py-2 border rounded @error('email') border-red-500 @enderror"
                                        value="{{ old('email', isset($user) ? $user->email : '') }}">
                                    @error('email')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Outros campos -->
                        <div class="mb-4">
                            <label for="occupation" class="block mb-2 campo-oculto">Profissão:</label>
                            <input type="text" name="occupation" id="occupation"
                                class="w-full px-4 py-2 border rounded campo-oculto @error('occupation') border-red-500 @enderror"
                                value="{{ old('occupation', isset($user) ? $user->occupation : '') }}">
                            @error('occupation')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="height" class="block mb-2 campo-oculto">CBO:</label>
                            <input type="text" name="height" id="height"
                                class="w-full px-4 py-2 border rounded campo-oculto @error('height') border-red-500 @enderror"
                                value="{{ old('height', isset($user) ? $user->height : '') }}">
                            @error('height')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Senha e confirmação de senha -->
                        <div class="mb-4">
                            <label for="password" class="block mb-2">Senha:</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2 border rounded @error('password') border-red-500 @enderror">
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block mb-2">Confirmar Senha:</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-2 border rounded @error('password_confirmation') border-red-500 @enderror">
                            @error('password_confirmation')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
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
        function ocultaCampos() {
            var tipo = document.getElementById('tipo').value;
            var camposOcultos = document.getElementsByClassName('campo-oculto');

            if (tipo === 'atendente') {
                for (var i = 0; i < camposOcultos.length; i++) {
                    camposOcultos[i].style.display = 'none';
                }
            } else {
                for (var i = 0; i < camposOcultos.length; i++) {
                    camposOcultos[i].style.display = 'block';
                }
            }
        }

        // Executar a função inicialmente para definir o estado correto dos campos
        ocultaCampos();
    </script>
</x-admin-layout>

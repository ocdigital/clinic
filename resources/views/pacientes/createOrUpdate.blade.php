<x-app-layout>
  <div class="container mx-auto">
      <div class="flex justify-center">
          <div class="w-3/4">
              <div class="bg-white shadow-md rounded-lg">
                  <div class="bg-gray-200 text-gray-800 px-6 py-4">{{ isset($paciente) ? 'Editar Paciente' : 'Criar Paciente' }}</div>

                  <div class="p-6">
                      <form action="{{ isset($paciente) ? route('pacientes.update', $paciente->id) : route('pacientes.store') }}" method="POST">
                          @csrf <!-- Adicione isso para proteção contra ataques CSRF -->

                          @if(isset($paciente))
                              @method('PUT') <!-- ou @method('PATCH') para usar o método PATCH -->
                          @else
                              @method('POST')
                          @endif

                          <div class="mb-4">
                              <label for="nome" class="block text-gray-700 font-bold mb-2">Nome:</label>
                              <input type="text" id="nome" name="nome" value="{{ isset($paciente) ? $paciente->nome : old('nome') }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-indigo-500">
                          </div>

                          <div class="mb-4">
                              <label for="data_nascimento" class="block text-gray-700 font-bold mb-2">Data de Nascimento:</label>
                              <input type="date" id="data_nascimento" name="data_nascimento" value="{{ isset($paciente) ? $paciente->data_nascimento : old('data_nascimento') }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-indigo-500">
                          </div>

                          <div class="mb-4">
                              <label for="sexo" class="block text-gray-700 font-bold mb-2">Sexo:</label>
                              <select id="sexo" name="sexo" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-indigo-500">
                                  <option value="Masculino" {{ isset($paciente) && $paciente->sexo === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                  <option value="Feminino" {{ isset($paciente) && $paciente->sexo === 'Feminino' ? 'selected' : '' }}>Feminino</option>
                              </select>
                          </div>

                          <div class="mb-4">
                              <label for="endereco" class="block text-gray-700 font-bold mb-2">Endereço:</label>
                              <input type="text" id="endereco" name="endereco" value="{{ isset($paciente) ? $paciente->endereco : old('endereco') }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-indigo-500">
                          </div>

                          <div class="mb-4">
                              <label for="telefone" class="block text-gray-700 font-bold mb-2">Telefone:</label>
                              <input type="tel" id="telefone" name="telefone" value="{{ isset($paciente) ? $paciente->telefone : old('telefone') }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-indigo-500">
                          </div>

                          <div class="mb-4">
                              <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                              <input type="email" id="email" name="email" value="{{ isset($paciente) ? $paciente->email : old('email') }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-indigo-500">
                          </div>

                          <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Salvar</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>

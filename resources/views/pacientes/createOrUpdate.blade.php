<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($event) ? 'Editar Paciete' : 'Criar Paciente' }}</div>

                    <div class="card-body">
                        <form action="{{ isset($paciente) ? route('pacientes.update', $paciente->id) : route('pacientes.store') }}" method="POST">
                            @csrf <!-- Adicione isso para proteção contra ataques CSRF -->
                          
                            @if(isset($paciente))
                              @method('PUT') <!-- ou @method('PATCH') para usar o método PATCH -->
                            @else
                              @method('POST')
                            @endif
                          
                            <div>
                              <label for="nome">Nome:</label>
                              <input type="text" id="nome" name="nome" value="{{ isset($paciente) ? $paciente->nome : old('nome') }}" required>
                            </div>
                          
                            <div>
                              <label for="data_nascimento">Data de Nascimento:</label>
                              <input type="date" id="data_nascimento" name="data_nascimento" value="{{ isset($paciente) ? $paciente->data_nascimento : old('data_nascimento') }}" required>
                            </div>
                          
                            <div>
                              <label for="sexo">Sexo:</label>
                              <select id="sexo" name="sexo" required>
                                <option value="Masculino" {{ isset($paciente) && $paciente->sexo === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Feminino" {{ isset($paciente) && $paciente->sexo === 'Feminino' ? 'selected' : '' }}>Feminino</option>
                              </select>
                            </div>
                          
                            <div>
                              <label for="endereco">Endereço:</label>
                              <input type="text" id="endereco" name="endereco" value="{{ isset($paciente) ? $paciente->endereco : old('endereco') }}" required>
                            </div>
                          
                            <div>
                              <label for="telefone">Telefone:</label>
                              <input type="tel" id="telefone" name="telefone" value="{{ isset($paciente) ? $paciente->telefone : old('telefone') }}" required>
                            </div>
                          
                            <div>
                              <label for="email">Email:</label>
                              <input type="email" id="email" name="email" value="{{ isset($paciente) ? $paciente->email : old('email') }}" required>
                            </div>
                          
                            <button type="submit">Salvar</button>
                          </form>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

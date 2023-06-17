<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($event) ? 'Editar Evento' : 'Criar Evento' }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($event) ? route('events.update', $event->id) : route('events.store') }}">
                            @csrf
                            @if(isset($event))
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="title">Título</label>
                                <input id="title" type="text" class="form-control" name="title" value="{{ isset($event) ? $event->title : old('title') }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="start">Data de Início</label>
                                <input id="start" type="date" class="form-control" name="start" value="{{ isset($event) ? $event->start->format('Y-m-d') : old('start') }}" required>
                            </div>

                            <!-- Outros campos do formulário aqui -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($event) ? 'Atualizar' : 'Criar' }} Evento
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

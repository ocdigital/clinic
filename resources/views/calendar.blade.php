<x-app-layout>

    <div class="col-12 auto">

        <div id='calendar'></div>

    </div>

    <!-- Modal Component -->
    <div x-data="eventFormHandler()" x-show="showModal" @open-modal.window="showModal = true" @close-modal.window="showModal = false" tabindex="-1">
        <template x-if="showModal">
            <x-modal name="create-event" :show="true" focusable>
                <form class="p-6" id="eventForm">
                    @csrf
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Criar Novo Evento') }}
                    </h2>

                    <input type="hidden" id="start" class="block w-full">
                    <input type="hidden" id="end" class="block w-full">

                    <div class="mt-4">
                        <label for="name">Nome:</label>
                        <select class="js-data-example-ajax block w-full" id="name" title="Search for a repository"
                        style="width:100%"></select>
                    </div>

                    <div class="mt-4">
                        <label for="celular">Celular</label>
                        <input type="text" name="celular" id="celular" class="block w-full" value="" readonly>
                    </div>

                    <div class="mt-4">
                        <label for="convenio">Convênio</label>
                        <input type="text" name="convenio" id="convenio" class="block w-full" value="" readonly>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button @click="showModal = false">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                        <x-danger-button class="ml-3" type="button" id="save" @click="open = saveEvent() ? false : open">
                            {{ __('Salvar') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </template>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src="{{ asset('/js/calendar.js') }}"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('eventFormHandler', () => ({
                showModal: false,
                init() {
                    this.$watch('showModal', value => {
                        if (value) {
                             this.initializeAutocomplete();
                            this.addSaveEventListener();

                            const startTime = sessionStorage.getItem('newEventStart');
                             const endTime = startTime;


                                document.getElementById('start').value = startTime;
                                document.getElementById('end').value = endTime;



                        }
                    });
                },
                initializeAutocomplete() {
                  $('.js-data-example-ajax').select2({
    ajax: {
        url: '/api/pacientes',
        dataType: 'json',
        delay: 250, // Adiciona um pequeno atraso antes de iniciar a pesquisa
        data: function (params) {
            return {
                termo_pesquisa: params.term, // O termo de pesquisa digitado pelo usuário
            };
        },
        processResults: function (data) {
            // Se nenhum nome for encontrado, adicionamos um resultado personalizado
            if (data.results.length === 0) {
                data.results.push({
                    id: 'not_found',
                    text: 'Nenhum nome encontrado. Cadastrar Novo?',
                    cadastrar: true,
                });
            }

            console.log(data.results[0]);

            document.getElementById('convenio').value = data.results[0].convenio_nome;
            document.getElementById('celular').value = data.results[0].telefone;

            return {
                results: data.results,
            };
        },
        cache: true,
    },
    minimumInputLength: 3, // Número mínimo de caracteres antes de começar a pesquisar
    templateResult: function (data) {
        // Personalizamos a exibição do resultado, adicionando um botão de cadastro
        if (data.cadastrar) {
            return $('<span><button class="btn btn-primary">Cadastrar Novo</button></span>');
        }
        return data.text;
    },
}).on('select2:select', function (e) {
    // Tratamos o evento de seleção, e aqui você pode adicionar a lógica para o botão Cadastrar Novo
    if (e.params.data.cadastrar) {
        alert('Lógica para cadastrar novo aqui');
        // Adicione sua lógica para abrir o formulário de cadastro ou realizar outra ação desejada
    }
});
                },
                addSaveEventListener() {
                    document.getElementById('save').addEventListener('click', this.saveEvent);
                },
                saveEvent() {
                    this.showModal = false;
                    // Aqui você pode adicionar a lógica para salvar o evento.
                    // Por exemplo, enviar os dados do formulário para o servidor.

                    const nameInput = document.getElementById('name');
                    const startInput = document.getElementById('start');
                    const endInput = document.getElementById('end');


                    if (nameInput && startInput && endInput) {
                        const eventData = {
                           title: nameInput.value,
                            start: startInput.value,
                            end: endInput.value,
                        };



                        try {
                            // Aqui você pode chamar a função para criar o evento no calendário.
                            createEvent(eventData);
                            return true;
                        } catch (error) {
                            console.error(error);
                            return false;
                        }
                    }

                    // Para fechar o modal após salvar, você pode alterar showModal para false
                }
            }));
        });

    </script>

</x-app-layout>

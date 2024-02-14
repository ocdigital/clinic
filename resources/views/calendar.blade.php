<x-app-layout>

    <div class="col-12 auto">
        <div id='calendar'></div>
    </div>


    <!-- Modal Component -->
<div x-data="eventFormHandler()" x-show="showModal" @open-modal.window="showModal = true" @close-modal.window="showModal = false">

    <template x-if="showModal">
        <x-modal name="create-event" :show="true" focusable>
            <form class="p-6" id="eventForm">
                @csrf
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Criar Novo Evento') }}
                </h2>
                <div>
                    <label for="name">Nome:</label>
                    <input type="text" id="name" class="block w-full">
                </div>
                <div>
                    <label for="phone">Telefone:</label>
                    <input type="text" id="phone" class="block w-full">
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


  <script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('eventFormHandler', () => ({
            showModal: false,
            init() {
                this.$watch('showModal', value => {
                    if (value) {
                        this.addSaveEventListener();
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


                const eventData = {
                    name: document.getElementById('name').value,
                    phone: document.getElementById('phone').value
                };

                console.log(eventData);

                 try {
                    // createEvent(eventData);
                    return true;
                } catch (error) {
                    console.error(error);
                    return false;
                }



                // createEvent('teste');
                // Para fechar o modal após salvar, você pode alterar showModal para false
            }
        }));
    });
  </script>

</x-app-layout>

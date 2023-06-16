<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <div class="col-12 auto">
        <div id='calendar'></div>
    </div>


    <div id="popup" style="display: none;">
        <label for="name">Nome:</label>
        <input type="text" id="name">
        <br>
        <label for="phone">Telefone:</label>
        <input type="text" id="phone">
        <br>

    </div>


  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
  <script src="{{ asset('/js/calendar.js') }}"></script>

</x-app-layout>
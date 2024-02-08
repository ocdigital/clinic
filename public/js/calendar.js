document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGridWeek',
      themeSystem: 'standard',
      height: 700,
      locale: 'pt-br',
      nowIndicator: true,
      navLinks: true,


      events: '/events',
      editable: true,
      selectable: true,
      selectHelper: true,
      displayEventEnd: false,
      eventDisplay: 'list-item',
      dayMaxEvents: true,
      dayMaxEventRows: true,
      dayMaxEventRows: true, // for all non-TimeGrid views
      views: {
        dayGridMonth: {
          dayMaxEventRows: 6 // adjust to 6 only for timeGridWeek/timeGridDay


        },
        timeGridWeek: {

        },
        timeGridDay: {

        },

      },
      allDaySlot: false,
      slotDuration: '00:30:00',
      defaultTimedEventDuration: '00:30:00', // tamanho do evento
      slotMinTime: '08:00:00', //Horário de funcionamento do calendário
      slotMaxTime: '18:00:00',
        slotLabelInterval: '00:30:00',
        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            omitZeroMinute: false,
            meridiem: 'short'
        },
        displayEventEnd: {
            month: true,
            basicWeek: true,
            "default": true
        },

        hiddenDays: [ 0, 6 ], // dias da semana que não aparecem no calendário


      //Horário de funcionamento do calendário

    businessHours: [
    {
        daysOfWeek: [1],
        startTime: '08:00',
        endTime: '12:00'
    },
    {
        daysOfWeek: [1],
        startTime: '13:00',
        endTime: '18:00'
    },
    {
        daysOfWeek: [2],
        startTime: '08:00',
        endTime: '12:00'
    },
    {
        daysOfWeek: [2],
        startTime: '13:00',
        endTime: '18:00'
    },
    {
        daysOfWeek: [3],
        startTime: '08:00',
        endTime: '12:00'
    },
    {
        daysOfWeek: [3],
        startTime: '13:00',
        endTime: '18:00'
    },
    {
        daysOfWeek: [4],
        startTime: '08:00',
        endTime: '12:00'
    },
    {
        daysOfWeek: [4],
        startTime: '13:00',
        endTime: '18:00'
    },
    {
        daysOfWeek: [5],
        startTime: '08:00',
        endTime: '12:00'
    },
    {
        daysOfWeek: [5],
        startTime: '13:00',
        endTime: '18:00'
    },
    {
        daysOfWeek: [6],
        startTime: '08:00',
        endTime: '12:00'
    },
    {
        daysOfWeek: [6],
        startTime: '13:00',
        endTime: '18:00'
    },
    ],



      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },

      //Click Date
      dateClick: function (date, jsEvent, view) {
        //extrair somente o horario do dia selecionado
        var time = moment(date.dateStr).format('HH:mm');
        //se horario estiver entre 12:00 e 13:00
        if(time >= '12:00' && time <= '13:00'){

        }
        else{
            $('#popup').dialog({
                title: 'Novo Evento',
                modal: true,
                buttons: {
                    Salvar: function () {
                        var name = $('#name').val();
                        var phone = $('#phone').val();
                        var eventData = {
                            title: name,
                            start: moment(date.dateStr).format('YYYY-MM-DD HH:mm'),
                            end: moment(date.dateStr).format('YYYY-MM-DD HH:mm')
                        };
                        createEvent(eventData);
                        $(this).dialog('close');
                    },
                    Cancelar: function () {
                        $(this).dialog('close');
                    }
                },
                open: function () {
                    $('#name').val('');
                    $('#phone').val('');
                }
            });
        }
        },

    eventClick: function (event, jsEvent, view) {
        $('#popup').dialog({
            title: 'Editar Evento',
            modal: true,
            buttons: {
                Salvar: function () {
                    var name = $('#name').val();
                    var phone = $('#phone').val();
                    var eventData = {
                        id: event['event']['id'],
                        title: name,
                        start: moment(event['event']['start']).format('YYYY-MM-DD HH:mm'),
                        end: moment(event['event']['start']).format('YYYY-MM-DD HH:mm')
                    };
                    updateEvent(eventData);
                    $(this).dialog('close');
                },
                Excluir: function () {
                    deleteEvent(event['event']['id']);
                    $(this).dialog('close');
                },
                Cancelar: function () {
                    $(this).dialog('close');
                }
            },
            open: function () {
                $('#name').val(event['event']['title']);
                $('#phone').val(event['event']['phone']);
            }
        });
    },//Fecha o eventClick

    eventDrop: function (event, delta, revertFunc) {
        console.log(event);
        var eventData = {
            id: event['event']['id'],
            title: event['event']['title'],
            start:moment(event['event']['start']).format('YYYY-MM-DD HH:mm'),
            end: moment(event['event']['start']).format('YYYY-MM-DD HH:mm'),
        };
        updateEvent(eventData);
    },//Fecha o eventDrop

    eventResize: function (event, delta, revertFunc) {
        console.log(event);
        var eventData = {
            id: event.id,
            id: event['event']['id'],
            title: event['event']['title'],
            start:moment(event['event']['start']).format('YYYY-MM-DD HH:mm'),
            end: moment(event['event']['end']).format('YYYY-MM-DD HH:mm'),
        };
        updateEvent(eventData);
    },//Fecha o eventResize
});//Fecha o calendário



function createEvent(eventData) {
    console.log(eventData);
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: '/events',
        type: 'POST',
        data: eventData,
        success: function (response) {
            eventData.id = response.id;
            calendar.refetchEvents();
        }
    });
}

function updateEvent(eventData) {
    console.log(eventData);
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: '/events/'+eventData.id,
        type: 'PUT',
        data: eventData,
        success: function (response) {
            calendar.refetchEvents();
        }
    });
}

function deleteEvent(eventId) {
    if (!confirm("Você tem certeza?")) {
        return false;
    }
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: '/events/'+eventId,
        type: 'DELETE',
        success: function (response) {
            calendar.refetchEvents();
        }
    });
}

    calendar.render();
});//Fecha o DOMContentLoaded

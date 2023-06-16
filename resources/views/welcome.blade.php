<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css' />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet'>
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    
    <script>
        $(document).ready(function () {
            $('#calendar').fullCalendar({
                themeSystem: 'bootstrap4',
                // eventDuration:'00:30:00',
                duration:'00:30:00',
                customButtons: {
                btnEncaixe: {
                    text: "Encaixe",
                    click: function() {
                        $("#modalEncaixe").modal("show");
                    }
                },
                btnProximos: {
                    text: "Próximos",
                    click: function() {
                        $("#modalProximos").modal("show");
                        proximosAtendimentosPorAgenda();
                    }
                }
                },
                buttonText: {
                    today: 'Hoje',
                    month: 'Mês',
                    week: 'Semana',
                    day: 'Dia',
                    list: 'Lista'
                },
               
                  
                header: {
                    left: 'prev,next today btnEncaixe',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                events: '/',
                editable: true,
                selectable: true,
                selectHelper: true,
                


            //use to listDay old format
           
                // ...
                dayClick: function (date, jsEvent, view) {
                    $('#popup').dialog({
                        title: 'Novo Evento',
                        modal: true,                      
                        buttons: {
                            Salvar: function () {
                                var name = $('#name').val();
                                var phone = $('#phone').val();
                                var eventData = {
                                    title: name,
                                    start: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                                    end: moment(event.end).format('YYYY-MM-DD HH:mm:ss')
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
                                    id: event.id,
                                    title: name,
                                    start: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                                    end: moment(event.end).format('YYYY-MM-DD HH:mm:ss')
                                    end: event.end.format()
                                };
                                updateEvent(eventData);
                                $(this).dialog('close');
                            },
                            Excluir: function () {
                                deleteEvent(event.id);
                                $(this).dialog('close');
                            },
                            Cancelar: function () {
                                $(this).dialog('close');
                            }
                        },
                        open: function () {
                            $('#name').val(event.title);
                            $('#phone').val(event.phone);
                        }
                    });
                },

                eventDrop: function (event, delta, revertFunc) {
                    console.log(event);
                    var eventData = {
                        id: event.id,
                        title: event.title,
                        start: event.start.toISOString(),
                        end: event.end ? event.end.toISOString() : event.start.toISOString()+1
                    };
                    updateEvent(eventData);
                },
            });

            function createEvent(eventData) {
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
                        // $('#calendar').fullCalendar('renderEvent', eventData, true);
                        $('#calendar').fullCalendar( 'refetchEvents'); 
                    }
                });
            }

            function updateEvent(eventData) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/events/' + eventData.id,
                    type: 'PUT',
                    data: eventData,
                    success: function (response) {
                        alert('Event updated successfully');
                        $('#calendar').fullCalendar( 'refetchEvents'); 
                    },
                    error: function (error) {
                        alert('Error updating event:', error);
                    }
                });
            }

            function deleteEvent(eventId) {
                if (confirm("Tem certeza de que deseja excluir o evento?")) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '/events/' + eventId,
                        type: 'DELETE',
                        success: function (response) {
                            console.log('Event deleted successfully');
                            $('#calendar').fullCalendar('removeEvents', eventId);
                            $('#calendar').fullCalendar( 'refetchEvents'); 
                        },
                        error: function (error) {
                            console.log('Error deleting event:', error);
                        }
                    });
                }
            }
            

        });
    </script>
    <style>
        /* ... */
    </style>
</head>
<body>
     <div id='calendar'></div>

    <div id="popup" style="display: none;">
        <label for="name">Nome:</label>
        <input type="text" id="name">
        <br>
        <label for="phone">Telefone:</label>
        <input type="text" id="phone">
        <br>
        <div id="confirm-buttons">
            <button id="delete-button">Excluir</button>
            <button id="cancel-button">Cancelar</button>
            <button id="save-button">Salvar</button>
        </div>
    </div>
</body>
</html>

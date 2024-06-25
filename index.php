<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/locales/it.global.min.js'></script> <!-- Aggiungi il file di localizzazione italiano -->
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                editable: true,
                locale: 'it', // Imposta la lingua italiana
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth' // Aggiunta della selezione delle viste
                },

                //INIZIO TRADUZIONE DEI PULSANTI
                buttonText: { // Traduzione dei pulsanti
                    today: 'Oggi',
                    month: 'Mese',
                    listMonth: 'Elenco mese',
                    prev: 'precedente',
                    next: 'prossimo',
                },
                allDayText: 'Tutto il giorno', // Traduzione del testo "all-day"
                //FINE TRADUZIONE DEI PULSANTI

                events: 'load_events.php',
                dateClick: function(info) {
                    $('#eventModal').modal('show');
                    $('#eventForm')[0].reset();
                    $('#start').val(info.dateStr);
                    $('#end').val(info.dateStr);
                },
                eventClick: function(info) {
                    $('#eventModal').modal('show');
                    $('#eventForm')[0].reset();
                    $('#eventId').val(info.event.id);
                    $('#title').val(info.event.title);
                    $('#start').val(info.event.startStr);
                    $('#end').val(info.event.endStr ? info.event.endStr : info.event.startStr);
                },
                eventDrop: function(info) {
                    $.post('update_event.php', {
                        id: info.event.id,
                        title: info.event.title,
                        start: info.event.startStr,
                        end: info.event.endStr ? info.event.endStr : info.event.startStr
                    }, function(response) {
                        if (response.success) {
                            alert('Evento aggiornato');
                        }
                    }, 'json');
                },
                eventResize: function(info) {
                    $.post('update_event.php', {
                        id: info.event.id,
                        title: info.event.title,
                        start: info.event.startStr,
                        end: info.event.endStr
                    }, function(response) {
                        if (response.success) {
                            alert('Evento aggiornato');
                        }
                    }, 'json');
                }
            });
            calendar.render();

            $('#saveEvent').click(function() {
                var id = $('#eventId').val();
                var url = id ? 'update_event.php' : 'create_event.php';
                var data = {
                    id: id,
                    title: $('#title').val(),
                    start: $('#start').val(),
                    end: $('#end').val()
                };
                $.post(url, data, function(response) {
                    if (response.success) {
                        $('#eventModal').modal('hide');
                        calendar.refetchEvents();
                    }
                }, 'json');
            });

            $('#deleteEvent').click(function() {
                var id = $('#eventId').val();
                if (id) {
                    if (confirm("Vuoi eliminare questo evento?")) {
                        $.post('delete_event.php', { id: id }, function(response) {
                            if (response.success) {
                                $('#eventModal').modal('hide');
                                calendar.refetchEvents();
                            }
                        }, 'json');
                    }
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div id='calendar'></div>
        <!-- Modal per creare/modificare eventi -->
        <div class="modal" id="eventModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Evento</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="eventForm">
                            <input type="hidden" id="eventId">
                            <div class="form-group">
                                <label for="title">Titolo:</label>
                                <input type="text" class="form-control" id="title" required>
                            </div>
                            <div class="form-group">
                                <label for="start">Inizio:</label>
                                <input type="date" class="form-control" id="start" required>
                            </div>
                            <div class="form-group">
                                <label for="end">Fine:</label>
                                <input type="date" class="form-control" id="end" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="deleteEvent">Elimina</button>
                        <button type="button" class="btn btn-primary" id="saveEvent">Salva</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Réservations</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bookingCalendar.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="calendar_container">
    <div id="calendar"></div>
</div>

<!-- Modal pour afficher les détails de l'événement -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Détails de l'Événement</h4>
            </div>
            <div class="modal-body">
                <p id="eventDetails">Chargement...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleteAppointments">Annuler</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridWeek',
            locale: 'fr',
            headerToolbar: {
                left: 'prev,next today',  
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay,timeslot'
            },
            buttonText: {
                timeslot: "+",  
                today: "Aujourd'hui",
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour'
            },
            customButtons: {
                timeslot: {
                text: '+',
                    click: function() {
                        alert('Créneau horaire sélectionné');  
                    }
                }
            },
            events: '/booking',  
            eventClick: function(info) {
                var eventDetails = "Client: " + (info.event.title || "Non spécifié") + " " + (info.event.extendedProps.surname || "Non spécifié") + "\n" +
                                   "Email: " + (info.event.extendedProps.email || "Non spécifié") + "\n" +
                                   "Description: " + (info.event.extendedProps.description || "Non spécifié") + "\n" +
                                   "Début: " + (info.event.start ? info.event.start.toLocaleString() : "Non spécifié") + "\n" +
                                   "Fin: " + (info.event.end ? info.event.end.toLocaleString() : "Non spécifié");

                document.getElementById('eventDetails').innerText = eventDetails;
                document.getElementById('myModalLabel').innerText = info.event.extendedProps.subject || "Non spécifié";

                document.getElementById('deleteAppointments').setAttribute('data-event-id', info.event.id);
                $('#myModal').modal('show');
            }
        });
        calendar.render();

        document.getElementById('deleteAppointments').addEventListener('click', function() {
            if (confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')) {
            var eventId = this.getAttribute('data-event-id');
            $.ajax({
                url: '/appointments/' + eventId,  
                method: 'DELETE',
                data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: eventId
                },
                success: function(response) {
                alert(response.message);
                $('#myModal').modal('hide'); 
                calendar.refetchEvents();     
                },
                error: function(response) {
                alert('Erreur lors de la suppression. Veuillez réessayer.');
                }
            });
            }
        });
        });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

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
                <button type="button" class="btn btn-secondary" id="deleteAppointment">Annuler</button>
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
            today: "Aujourd'hui",
            month: 'Mois',
            week: 'Semaine',
            day: 'Jour'
        },
        customButtons: {
            timeslot: {
                text: ' + ',
                click: function() {
                    alert('Créneau horaire sélectionné');
                },
                className: 'timeslot-button',
            }
        },
        events: '/booking',  
        eventClick: function(info) {
            document.getElementById('eventDetails').innerText = 
                "Email: " + info.event.extendedProps.email + "\n" +
                "Matière: " + info.event.extendedProps.subject + "\n" +
                "Description: " + info.event.extendedProps.description + "\n" +
                "Début: " + info.event.start.toLocaleString() + "\n" +
                "Fin: " + info.event.end.toLocaleString();
            document.getElementById('myModalLabel').innerText = info.event.title + " " + info.event.extendedProps.surname;
            
            // Ajouter l'ID de l'événement au bouton "Annuler"
            document.getElementById('deleteAppointment').setAttribute('data-event-id', info.event.id);
            
            $('#myModal').modal('show');
        }
    });
    calendar.render();

    // Fonction pour supprimer un rendez-vous
    document.getElementById('deleteAppointment').onclick = function() {
        var appointmentId = this.getAttribute('data-event-id');
        deleteAppointment(appointmentId);
        $('#myModal').modal('hide');
    }


    
        calendar.render();
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

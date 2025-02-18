<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Réservations</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel = "stylesheet" href="{{ asset('css/modal.css') }}">
    <link rel = "stylesheet" href="{{ asset('css/bookingCalendar.css') }}">

</head>
<body>

<div class="container">
    <h2>Calendrier des Réservations</h2>
    <div id="calendar"></div>
</div>

<!-- Modal Bootstrap -->
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'fr',
            events: '/booking',  // Mettre le bon chemin d'API pour récupérer les événements
            eventClick: function(info) {
                // Modifier le texte du modal avec les détails de l'événement
                document.getElementById('eventDetails').innerText = 
                    "Titre: " + info.event.title + "\n" +
                    "Début: " + info.event.start.toLocaleString() + "\n" +
                    (info.event.end ? "Fin: " + info.event.end.toLocaleString() : "");

                // Ouvrir le modal Bootstrap
                $('#myModal').modal('show');
            }
        });
        calendar.render();
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

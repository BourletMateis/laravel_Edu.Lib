<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Réservations</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <style>
        #calendar {
            max-width: 900px;
            margin: 40px auto;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Calendrier des Réservations</h2>
    <div id='calendar'></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', 
                events: '/booking',  
                eventColor: '#378006', 
                eventClick: function(info) {
                    alert("Début : " + info.event.start + "\nFin : " + info.event.end);
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Réservations</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <style>
        #calendar {
            max-width: 1000px;
            margin: 50px auto;
        }
        .fc-daygrid-event {
            background-color: #378006;
            color: #fff;
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
                displayEventStart: true,
                displayEventEnd: true,
                eventOrder: 'start',
                locale: 'fr',
                events: '/booking',  
                eventColor: '#378006', 
                eventClick: function(info) {
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>

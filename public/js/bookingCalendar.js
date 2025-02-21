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
                text: '+',
                click: function() {
                    $('#scheduleModal').modal('show');
                }
            }
        },
        events: '/booking',
        eventSources: [
            {
                url: '/schedule_load',
                method: 'GET',
            }
        ],
        eventDidMount: function(info) {
            var startTime = info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            var endTime = info.event.end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            if (info.event.source.url === '/booking') {
                info.el.innerHTML = "<div class='fc-event-title'> " + startTime + " - " + endTime + " " + info.event.title + "</div>";
            } else {
                info.el.innerHTML = "<div class='fc-event-title'>" + startTime + " - " + endTime + " " + "Libre" + "</div>";
            }
        },
        eventClick: function(info) {
            var isBookingEvent = info.event.source.url === '/booking';
            var eventDetails = "Début: " + (info.event.start ? info.event.start.toLocaleString() : "Non spécifié") + "\n" +
                               "Fin: " + (info.event.end ? info.event.end.toLocaleString() : "Non spécifié");

            if (isBookingEvent) {
                eventDetails =
                    "Matière: " + (info.event.extendedProps.subject || "Non spécifié") + "\n" +
                    "Description: " + (info.event.extendedProps.description || "Non spécifié") + "\n" +
                    "Prix: " + (info.event.extendedProps.price || "Non spécifié") + "€" + "\n" +
                    "Email: " + (info.event.extendedProps.email || "Non spécifié") + "\n" +
                    "Début: " + (info.event.start ? info.event.start.toLocaleString() : "Non spécifié") + "\n" +
                    "Fin: " + (info.event.end ? info.event.end.toLocaleString() : "Non spécifié");
            }

            document.getElementById('eventDetails').innerText = eventDetails;
            document.getElementById('myModalLabel').innerText = info.event.title;
            document.getElementById('deleteAppointments').setAttribute('data-event-id', info.event.id);
            document.getElementById('deleteAppointments').setAttribute('data-event-type', isBookingEvent ? 'booking' : 'schedule');
            $('#myModal').modal('show');
        }
    });
    
    calendar.render();

    document.getElementById('deleteAppointments').addEventListener('click', function() {
        if (confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')) {
            var eventId = this.getAttribute('data-event-id');
            var eventType = this.getAttribute('data-event-type');
            var url = eventType === 'booking' ? '/appointments/' + eventId : '/schedule/' + eventId;

            $.ajax({
                url: url,
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

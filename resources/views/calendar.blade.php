
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Réservations</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bookingCalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toolbarAdmin.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="calendar_container">
    <div id="calendar"></div>
</div>

<!-- Modal pour ajouter une horaire -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="scheduleModalLabel">Ajouter un horaire</h5>
            </div>
            <div class="modal-body">
                <form action="{{ url('schedules') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="day">Jour</label>
                        <select id="day" name="day" required>
                            @foreach ($days as $key => $item)
                                <option value="{{ $item }}">{{ __('pages.days.'.$item) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="time_start">Heure de début</label>
                        <select name="time_start" id="time_start" class="form-control" required>
                            @foreach ($availableSlots as $slot)
                                <option value="{{ $slot }}">{{ $slot }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="time_end">Heure de fin</label>
                        <select name="time_end" id="time_end" class="form-control" required>
                            @foreach ($availableSlots as $slot)
                                <option value="{{ $slot }}">{{ $slot }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#scheduleModal').modal('hide');">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
                <hr>
                <!-- Liste des horaires -->
                <h3>Mes horaires</h3>
                @foreach ($schedules as $schedule)
                    <div class="schedule-item">
                        <p>{{ __('pages.days.'.$schedule->day) }} | {{ $schedule->time_start }} - {{ $schedule->time_end }}</p>
                        <form action="{{ url('schedules/' . $schedule->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
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
                <button type="button" class="btn btn-danger" id="deleteAppointments">Supprimer</button>
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
                // Vérifie si l'événement provient de /booking
                if (info.event.source.url === '/booking') {
                    var startTime = info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    var endTime = info.event.end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    info.el.innerHTML = "<div class='fc-event-title'> " + startTime + " - " + endTime + " " + info.event.title + "</div>";
                } else {
                    var startTime = info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    var endTime = info.event.end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    info.el.innerHTML = "<div class='fc-event-title'>" + startTime + " - " + endTime + " " + "Libre" + "</div>";
                }
            },
            eventClick: function(info) {
                var isBookingEvent = false;
                if (info.event.source.url === '/booking') {
                    isBookingEvent = true;
                    var eventDetails =
                        "Matière: " + (info.event.extendedProps.subject || "Non spécifié") + "\n" +
                        "Description: " + (info.event.extendedProps.description || "Non spécifié") + "\n" +
                        "Email: " + (info.event.extendedProps.email || "Non spécifié") + "\n" +
                        "Début: " + (info.event.start ? info.event.start.toLocaleString() : "Non spécifié") + "\n" +
                        "Fin: " + (info.event.end ? info.event.end.toLocaleString() : "Non spécifié");
                    document.getElementById('eventDetails').innerText = "";
                    document.getElementById('eventDetails').innerText = eventDetails;
                    document.getElementById('myModalLabel').innerText = info.event.title;
                    document.getElementById('deleteAppointments').setAttribute('data-event-id', info.event.id);
                    document.getElementById('deleteAppointments').setAttribute('data-event-type', 'booking'); // Marqueur pour l'événement de réservation
                    $('#myModal').modal('show');
                } else {
                    isBookingEvent = false;
                    var eventDetails =
                        "Début: " + (info.event.start ? info.event.start.toLocaleString() : "Non spécifié") + "\n" +
                        "Fin: " + (info.event.end ? info.event.end.toLocaleString() : "Non spécifié");
                    document.getElementById('eventDetails').innerText = eventDetails;
                    document.getElementById('myModalLabel').innerText = info.event.title;
                    document.getElementById('deleteAppointments').setAttribute('data-event-id', info.event.id);
                    document.getElementById('deleteAppointments').setAttribute('data-event-type', 'schedule'); // Marqueur pour l'événement d'horaire
                    $('#myModal').modal('show');
                }
            }
        });
        calendar.render();

        document.getElementById('deleteAppointments').addEventListener('click', function() {
            if (confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')) {
                var eventId = this.getAttribute('data-event-id');
                var eventType = this.getAttribute('data-event-type');

                if (eventType === 'booking') {
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
                } else if (eventType === 'schedule') {
                    $.ajax({
                        url: '/schedule/' + eventId,
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
            }
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</body>
</html>



<?php
require_once 'C:\xampp\htdocs\laravel_Edu.Lib\app\View\toolbarAdmin.php';

// Créer une instance de la barre d'outils
$toolbar = new Toolbar();

// Ajouter des boutons avec leurs icônes SVG
$toolbar->addButton('
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
', '/home', 'Accueil');

$toolbar->addButton('
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
    </svg>
', '/profile', 'Profil');

$toolbar->addButton('
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
        <circle cx="12" cy="12" r="3"/>
    </svg>
', '/settings', 'Paramètres');
?>


<?php
    // Afficher la barre d'outils
    echo $toolbar->render();
    ?>

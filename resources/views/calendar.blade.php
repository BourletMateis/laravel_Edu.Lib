
<!doctype html>
<html lang="fr">

<head>
    <title>Calendrier des Réservations</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bookingCalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toolbarAdmin.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/bookingCalendar.js') }}"></script>

</head>
<body>
<header>
      <div class="container">
        <h1>Calendrier des rendez-vous</h1>
      </div>
    </header>

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

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                        @can('create', new \App\Models\Schedule())
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        @endcan
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
                    @can('delete', new \App\Models\Schedule())
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    @endcan
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



<?php
require_once base_path('app/View/toolbarAdmin.php');
    echo $toolbar->render();
    ?>

</body>
</html>








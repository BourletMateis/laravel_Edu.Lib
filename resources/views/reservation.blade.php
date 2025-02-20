<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Rendez-vous</title>
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">

</head>

<body>
<div class="container">
    <div class="dates">
        <div class="date-item">
            <h3>
                <select id="day">
                    @foreach($schedules as $day)
                        <option value="{{$days->day}}"></option>
                    @endforeach
                </select>
            </h3>
            <!--
            <div class="hours">
                <div>10h30</div>
                <div>11h00</div>
                <div>11h30</div>
                <div>13h00</div>
                <div>18h30</div>
            </div>
            -->
        </div>
    </div>

    <div class="profile">
        <img src="{{ asset('img/lama.jpg') }}" alt="Photo du professeur">
        <h2>
            <select id="prof-selector">
                @foreach($professeurs as $professeur)
                    <option value="{{ $professeur->id }}">{{ $professeur->name }} {{ $professeur->surname }} - {{ $professeur->specialite }}</option>
                @endforeach
            </select>
        </h2>
    </div>

    <script src="{{ asset('js/reservation.js') }}"></script>

    <div id="confirmation-popup" class="popup" style="display: none;">
        <div class="popup-content">
            <h3>Confirmation de réservation</h3>
            <p id="confirmation-info"></p>
            <div class="duration-options">
                <button onclick="confirmReservation('1h')">Réserver 1h</button>
                <button onclick="confirmReservation('2h')">Réserver 2h</button>
            </div>
            <div class="popup-actions">
                <button onclick="closePopup()">Annuler</button>
                <button onclick="finalizeReservation()">Confirmer</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>

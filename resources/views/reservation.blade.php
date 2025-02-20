@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<body>
<div class="content">
        <div class="container-dates">
            <div class="dates">
                <div class="date-item">
                    <h3>Disponibilités :</h3>
            <!-- Élément où les disponibilités seront affichées -->
            <div id="scheduleList"></div>
          </div>
        </div>

        <div class="profile">
          <img src="{{ asset('img/lama.jpg') }}" alt="Photo du professeur">
          <h2>
            <select id="prof-selector">
              @foreach($professeurs as $professeur)
              <option value="{{ $professeur->id }}|{{ $professeur->name }}|{{ $professeur->specialite }}">
                {{ $professeur->name }} {{ $professeur->surname }} - {{ $professeur->specialite }}
              </option>
              @endforeach
            </select>
          </h2>
        </div>

        <!-- Popup de confirmation -->
        <div id="confirmation-popup" class="popup" style="display: none;">
          <div class="popup-content">
            <h3>Confirmation de réservation</h3>
            <p id="confirmation-info"></p>
            <!-- Champ de sélection de date (seulement mardi) -->
            <div>
              <label for="date-picker">Choisir un mardi :</label>
              <input type="text" id="date-picker" name="date-picker">
            </div>
            <div class="popup-actions">
              <button onclick="closePopup()">Annuler</button>
              <button onclick="finalizeReservation()">Confirmer</button>
            </div>
          </div>
        </div>
      </div>

  <script>
    document.addEventListener("DOMContentLoaded", function(){
      flatpickr("#date-picker", {
        enable: [
          function(date) {
            return date.getDay() === 2;
          }
        ],
        dateFormat: "Y-m-d"
      });
      fetchSchedules();
      document.getElementById('prof-selector').addEventListener("change", fetchSchedules);
    });

    function fetchSchedules() {
  fetch("{{ route('schedule.list') }}")
    .then(response => response.json())
    .then(data => {
      let scheduleContainer = document.getElementById('scheduleList');
      scheduleContainer.innerHTML = '';

      let selectedProf = document.getElementById('prof-selector').value.split('|')[0];

      // 1. Filtrer les disponibilités du professeur sélectionné
      let filteredSchedules = data.filter(schedule => schedule.user_teacher_id == selectedProf);

      // 2. Regrouper par jour en fusionnant les horaires
      let groupedSchedules = {};
      filteredSchedules.forEach(schedule => {
        if (!groupedSchedules[schedule.day]) {
          groupedSchedules[schedule.day] = [];
        }
        groupedSchedules[schedule.day] = [...new Set([...groupedSchedules[schedule.day], ...schedule.hours])]; // Évite les doublons
      });

      // 3. Affichage des jours et horaires
      Object.entries(groupedSchedules).forEach(([day, hours]) => {
        let dayButton = document.createElement('button');
        dayButton.innerHTML = `<strong>Jour :</strong> ${day} <br><hr>`;
        dayButton.classList.add('day-button');
        scheduleContainer.appendChild(dayButton);

        // Créer un conteneur pour les horaires (caché au début)
        let hourContainer = document.createElement('div');
        hourContainer.classList.add('hour-container');
        hourContainer.style.display = 'none';
        scheduleContainer.appendChild(hourContainer);

        hours.forEach(hour => {
          let hourButton = document.createElement('button');
          hourButton.classList.add('hour-button');
          hourButton.setAttribute('data-day', day);
          hourButton.innerHTML = `<strong>Heure :</strong> ${hour} <br><hr>`;
          hourButton.onclick = () => {
            selectHour(day, hour);
          };
          hourContainer.appendChild(hourButton);
        });

        // Ajouter un événement de clic pour afficher/masquer les horaires
        dayButton.onclick = () => {
          hourContainer.style.display = hourContainer.style.display === 'none' ? 'block' : 'none';
        };
      });

      if (Object.keys(groupedSchedules).length === 0) {
        scheduleContainer.innerHTML = "<p>Aucune disponibilité pour ce professeur.</p>";
      }
    })
    .catch(error => console.error("Erreur lors de la récupération :", error));
}



    let selectedDay, selectedHour;
    function selectHour(day, hour) {
      selectedDay = day;
      selectedHour = hour;
      document.getElementById('confirmation-popup').style.display = 'block';
      document.getElementById('confirmation-info').innerHTML = `
        Vous avez choisi <strong>${day}</strong> à <strong>${hour}</strong>.<br>
        Choisissez une date (seulement mardi) et confirmez votre réservation.`;
    }

    function finalizeReservation() {
      let chosenDate = document.getElementById('date-picker').value;
      if (!chosenDate) {
        alert("Veuillez sélectionner un mardi.");
        return;
      }

      alert(`Réservation confirmée pour ${selectedDay} à ${selectedHour} le ${chosenDate}`);
      createAppointments(chosenDate, selectedHour);

      closePopup();
    }

    function closePopup() {
      document.getElementById('confirmation-popup').style.display = 'none';
    }

  function createAppointments(chosenDate,hour) {
    const selectedTeacherId = document.getElementById('prof-selector').value.split('|')[0];
    let user = @json(Auth::id());

    $.ajax({
    url: '/createappointment',
    method: 'POST',
    data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        date: chosenDate,
        start_time: hour + ":00",
        end_time: (parseInt(hour) + 1) + ":00:00",
        user_teacher_id: selectedTeacherId,
        user_student_id: user,
        title: "Réservation de rendez-vous",
        description: "Rendez-vous avec le professeur",
        price: 11.88
    },
    success: function(response) {
        alert("Réservation effectuée avec succès.");
        closePopup();
        fetchSchedules();
    },
    error: function(xhr, status, error) {
        console.error("Erreur:", error);
        alert('Erreur lors de la réservation.');
    }
});
}
  </script>
 </div>
</body>
@endsection

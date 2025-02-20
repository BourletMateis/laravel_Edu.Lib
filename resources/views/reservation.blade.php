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
      fetch('/list')
        .then(response => response.json())
        .then(data => {
          let scheduleContainer = document.getElementById('scheduleList');
          scheduleContainer.innerHTML = '';

          let selectedProf = document.getElementById('prof-selector').value.split('|')[0];

          data.forEach(schedule => {
            if (schedule.user_teacher_id == selectedProf) {
              let div = document.createElement('button');
              div.innerHTML = `<strong>Jour :</strong> ${schedule.day} <br><hr>`;
              scheduleContainer.appendChild(div);
              div.onclick = () => {
                schedule.hours.forEach(hour => {
                  let hourButton = document.createElement('button');
                  hourButton.classList.add('hour-button');
                  hourButton.setAttribute('data-day', schedule.day);
                  hourButton.innerHTML = `<strong>Heure :</strong> ${hour} <br><hr>`;
                  hourButton.onclick = () => {
                    selectHour(schedule.day, hour);
                  };
                  scheduleContainer.appendChild(hourButton);
                });
              };
            }
          });

          if (scheduleContainer.innerHTML === '') {
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
        Choisissez une date (seulement mardi) et confirmez votre réservation.
      `;
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

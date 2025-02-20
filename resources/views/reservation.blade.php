<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réservation de Rendez-vous</title>
  <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
  <div class="container">
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
    // Initialisation de Flatpickr sur le champ de date dans le popup
    document.addEventListener("DOMContentLoaded", function(){
      flatpickr("#date-picker", {
        enable: [
          function(date) {
            // Seuls les mardis (getDay() retourne 2 pour mardi)
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
          scheduleContainer.innerHTML = ''; // Vide le contenu précédent

          let selectedProf = document.getElementById('prof-selector').value.split('|')[0]; // Récupère l'ID du professeur

          // Filtrage des disponibilités pour le professeur sélectionné
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
      createAppointments(chosenDate);
      alert(`Réservation confirmée pour ${selectedDay} à ${selectedHour} le ${chosenDate}`);

      closePopup();
    }

    function closePopup() {
      document.getElementById('confirmation-popup').style.display = 'none';
    }

  function createAppointments(chosenDate) {
    const selectedTeacherId = document.getElementById('prof-selector').value.split('|')[0];
    
    $.ajax({
    url: '/createappointment', 
    method: 'POST', 
    data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        date: "2027-10-12", 
        start_time: "10:00:00", 
        end_time: "20:00:00", 
        user_teacher_id: 3, 
        user_student_id: 1, 
        title: "Réservation de rendez-vous", 
        description: "Rendez-vous avec le professeur",
        price: 60.11 
    },
    success: function(response) {
        alert(response.message); 
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
</body>
</html>

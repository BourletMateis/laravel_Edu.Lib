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

        <div id="confirmation-popup" class="popup" style="display: none;">
          <div class="popup-content">
            <h3>Confirmation de réservation</h3>
            <p id="confirmation-info"></p>
            <div>
            <label for="date-picker" id="date-label">Choisir un jour :</label>
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
        let flatpickrInstance;
        function initializeDatePicker(day) {
            if (flatpickrInstance) {
                flatpickrInstance.destroy();
            }

            flatpickrInstance = flatpickr("#date-picker", {
                minDate: new Date(),
                enable: [
                    function(date) {
                        return date.getDay() === day; 
                    }
                ],
                dateFormat: "Y-m-d",
            });
        }
        document.addEventListener("DOMContentLoaded", function(){
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

                    let filteredSchedules = data.filter(schedule => schedule.user_teacher_id == selectedProf);

                    let groupedSchedules = {};
                    filteredSchedules.forEach(schedule => {
                        if (!groupedSchedules[schedule.day]) {
                            groupedSchedules[schedule.day] = [];
                        }
                        groupedSchedules[schedule.day] = [...new Set([...groupedSchedules[schedule.day], ...schedule.hours])]; 
                    });
        const daysTranslations = {
            monday: 'Lundi',
            tuesday: 'Mardi',
            wednesday: 'Mercredi',
            thursday: 'Jeudi',
            friday: 'Vendredi',
            saturday: 'Samedi',
            sunday: 'Dimanche'
        };

      Object.entries(groupedSchedules).forEach(([day, hours]) => {
        let dayButton = document.createElement('button');
        let translatedDay = daysTranslations[day] || day;
                    dayButton.innerHTML = `<strong>Jour :</strong> ${translatedDay} <br><hr>`;
                    dayButton.classList.add('day-button');
                    scheduleContainer.appendChild(dayButton);

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

                        dayButton.onclick = () => {
                            hourContainer.style.display = hourContainer.style.display === 'none' ? 'block' : 'none';
                            switch(day) {
                              case "monday":
                                initializeDatePicker(1);
                                break;
                              case "tuesday":
                                initializeDatePicker(2);
                                break;
                              case "wednesday":
                                initializeDatePicker(3);
                                break;
                              case "thursday":
                                initializeDatePicker(4);
                                break;
                              case "friday":
                                initializeDatePicker(5);
                                break;
                              case "saturday":
                                initializeDatePicker(6);
                                break;
                              case "sunday":
                                initializeDatePicker(0);
                                break;
                            }
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
            document.getElementById('date-label').innerText = "Choisir un " + daysTranslations[day] + " :";
            document.getElementById('confirmation-info').innerHTML = `
            Vous avez choisi <strong>${daysTranslations[day]}</strong> à <strong>${hour}</strong>.
            Choisissez une date et confirmez votre réservation.`;
        }

        function finalizeReservation() {
            let chosenDate = document.getElementById('date-picker').value;
            if (!chosenDate) {
              alert("Erreur: Veuillez choisir une date.");
              return;
            }
      alert(`Réservation confirmée le ${chosenDate} à ${selectedHour} `);
      createAppointments(chosenDate, selectedHour);

      closePopup();
    }

        function closePopup() {
            document.getElementById('confirmation-popup').style.display = 'none';
        }

        function createAppointments(chosenDate, hour) {
            const selectedTeacherId = document.getElementById('prof-selector').value.split('|')[0];
            let user = @json(Auth::id());
            $.ajax({
                url: '/createappointment',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    date: chosenDate,
                    start_time: hour + ":00",
                    end_time: "0"+(parseInt(hour) + 1) + ":00:00",
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
                    sendEmailConfirmation();

                },
                error: function(xhr, status, error) {
                    console.error("Erreur:", error);
                    alert("Un rendez-vous est déjà présent");
                }
            });
            function sendEmailConfirmation() {
      $.ajax({
          url: '{{ route('sendmail') }}',
          method: 'GET',
          success: function(response) {
              alert("Email de confirmation envoyé !");
          },
          error: function(xhr, status, error) {
              console.error("Erreur d'envoi d'email:", error);
          }
      });
    }
}
  </script>
 </div>
</body>
@endsection

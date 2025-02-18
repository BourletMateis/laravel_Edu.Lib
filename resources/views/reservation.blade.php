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
        <!-- Liste des jours avec plusieurs journées supplémentaires -->
        <div class="date-item" onclick="toggleHours(this)">Lundi 19 Février
            <div class="hours">
                <div>10h30</div>
                <div>11h00</div>
                <div>11h30</div>
                <div>13h00</div>
                <div>18h30</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Mardi 20 Février
            <div class="hours">
                <div>09h30</div>
                <div>10h00</div>
                <div>15h00</div>
                <div>16h30</div>
                <div>19h00</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Mercredi 21 Février
            <div class="hours">
                <div>08h30</div>
                <div>09h00</div>
                <div>10h00</div>
                <div>12h00</div>
                <div>16h00</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Jeudi 22 Février
            <div class="hours">
                <div>10h00</div>
                <div>11h30</div>
                <div>13h00</div>
                <div>14h30</div>
                <div>19h00</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Vendredi 23 Février
            <div class="hours">
                <div>08h30</div>
                <div>10h00</div>
                <div>13h30</div>
                <div>15h00</div>
                <div>18h00</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Samedi 24 Février
            <div class="hours">
                <div>09h00</div>
                <div>10h30</div>
                <div>12h00</div>
                <div>14h00</div>
                <div>16h30</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Dimanche 25 Février
            <div class="hours">
                <div>10h00</div>
                <div>11h30</div>
                <div>13h00</div>
                <div>15h00</div>
                <div>17h30</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Lundi 26 Février
            <div class="hours">
                <div>09h00</div>
                <div>10h00</div>
                <div>12h30</div>
                <div>15h00</div>
                <div>18h00</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Mardi 27 Février
            <div class="hours">
                <div>08h00</div>
                <div>10h00</div>
                <div>11h30</div>
                <div>14h30</div>
                <div>17h00</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Mercredi 28 Février
            <div class="hours">
                <div>09h00</div>
                <div>10h30</div>
                <div>13h00</div>
                <div>16h00</div>
                <div>18h30</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Jeudi 1er Mars
            <div class="hours">
                <div>09h30</div>
                <div>11h00</div>
                <div>13h00</div>
                <div>15h30</div>
                <div>17h30</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Vendredi 2 Mars
            <div class="hours">
                <div>08h30</div>
                <div>10h30</div>
                <div>12h00</div>
                <div>14h00</div>
                <div>16h30</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Samedi 3 Mars
            <div class="hours">
                <div>09h00</div>
                <div>10h00</div>
                <div>11h30</div>
                <div>13h30</div>
                <div>15h30</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Dimanche 4 Mars
            <div class="hours">
                <div>09h30</div>
                <div>11h00</div>
                <div>12h30</div>
                <div>14h00</div>
                <div>16h00</div>
            </div>
        </div>
        <!-- Jours supplémentaires -->
        <div class="date-item" onclick="toggleHours(this)">Lundi 5 Mars
            <div class="hours">
                <div>10h30</div>
                <div>11h00</div>
                <div>12h30</div>
                <div>14h30</div>
                <div>16h00</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Mardi 6 Mars
            <div class="hours">
                <div>08h00</div>
                <div>10h00</div>
                <div>11h30</div>
                <div>13h00</div>
                <div>15h30</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Mercredi 7 Mars
            <div class="hours">
                <div>09h00</div>
                <div>10h30</div>
                <div>13h30</div>
                <div>16h00</div>
                <div>17h30</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Jeudi 8 Mars
            <div class="hours">
                <div>09h30</div>
                <div>11h00</div>
                <div>12h00</div>
                <div>14h30</div>
                <div>15h30</div>
            </div>
        </div>
        <div class="date-item" onclick="toggleHours(this)">Vendredi 9 Mars
            <div class="hours">
                <div>10h00</div>
                <div>11h30</div>
                <div>13h00</div>
                <div>15h00</div>
                <div>17h00</div>
            </div>
        </div>
    </div>
    <div class="profile">
        <img src="{{ asset('img/lama.jpg') }}" alt="Photo du professeur">
        <h2>Jean Dupont</h2>
        <p>Matière enseignée : Mathématiques</p>
    </div>
</div>


<script src="{{ asset('js/reservation.js') }}"></script>
<!-- Popup de confirmation de réservation -->
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


<script>
    function toggleHours(element) {
        let hours = element.querySelector('.hours');
        let allHours = document.querySelectorAll('.hours');
        allHours.forEach(h => { if (h !== hours) h.style.display = 'none'; });
        hours.style.display = (hours.style.display === 'block') ? 'none' : 'block';
    }
</script>
</body>
</html>

let selectedTime = '';
let selectedDate = '';
let selectedDuration = '';

// Fonction pour afficher le popup de confirmation
function showConfirmationPopup(time, date) {
    selectedTime = time;
    selectedDate = date;

    // Met à jour le texte du popup
    document.getElementById('confirmation-info').innerText = `Confirmer la réservation pour le ${date} à ${time}`;

    // Affiche la popup
    document.getElementById('confirmation-popup').style.display = 'flex';
}

// Fonction pour fermer le popup
function closePopup() {
    document.getElementById('confirmation-popup').style.display = 'none';
}

// Fonction pour choisir la durée (1h ou 2h)
function confirmReservation(duration) {
    selectedDuration = duration;
    // Mettre à jour le texte du popup avec la durée choisie
    document.getElementById('confirmation-info').innerText = `Réservation de ${selectedDuration} pour le ${selectedDate} à ${selectedTime}`;
}

// Fonction pour finaliser la réservation
function finalizeReservation() {
    alert(`Réservation confirmée pour le ${selectedDate} à ${selectedTime} pour ${selectedDuration}`);
    closePopup();
}

// Fonction pour afficher les heures disponibles dans le menu déroulant
function toggleHours(element) {
    let hours = element.querySelector('.hours');
    let allHours = document.querySelectorAll('.hours');
    allHours.forEach(h => { if (h !== hours) h.style.display = 'none'; });
    hours.style.display = (hours.style.display === 'block') ? 'none' : 'block';
}

// Fonction pour ouvrir la popup de réservation en cliquant sur une heure
document.querySelectorAll('.hours div').forEach(hour => {
    hour.addEventListener('click', function() {
        const time = this.innerText;
        const date = this.closest('.date-item').innerText.split('\n')[0]; // Récupère la date du jour
        showConfirmationPopup(time, date);
    });
});

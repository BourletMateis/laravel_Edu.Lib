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



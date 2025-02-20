let selectedTime = '';
let selectedDate = '';
let selectedDuration = '';

function showConfirmationPopup(time, date) {
    selectedTime = time;
    selectedDate = date;
    document.getElementById('confirmation-info').innerText = `Confirmer la réservation pour le ${date} à ${time}`;
    document.getElementById('confirmation-popup').style.display = 'flex';
}

function closePopup() {
    document.getElementById('confirmation-popup').style.display = 'none';
}

function confirmReservation(duration) {
    selectedDuration = duration;
    document.getElementById('confirmation-info').innerText = `Réservation de ${selectedDuration} pour le ${selectedDate} à ${selectedTime}`;
}

function finalizeReservation() {
    alert(`Réservation confirmée pour le ${selectedDate} à ${selectedTime} pour ${selectedDuration}`);
    closePopup();
}

function toggleHours(element) {
    let hours = element.querySelector('.hours');
    let allHours = document.querySelectorAll('.hours');
    allHours.forEach(h => { if (h !== hours) h.style.display = 'none'; });
    hours.style.display = (hours.style.display === 'block') ? 'none' : 'block';
}

document.querySelectorAll('.hours div').forEach(hour => {
    hour.addEventListener('click', function() {
        const time = this.innerText;
        const date = this.closest('.date-item').innerText.split('\n')[0]; 
        showConfirmationPopup(time, date);
    });
});



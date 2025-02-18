<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Rendez-vous</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="dates">
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
    </div>
    <div class="profile">
        <img src="prof.jpg" alt="Photo du professeur">
        <h2>Jean Dupont</h2>
        <p>Matière enseignée : Mathématiques</p>
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

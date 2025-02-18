<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilités</title>
</head>
<body>
<h1>Créneaux Horaires Disponibles</h1>
<table border="1">
    <tr>
        <th>Kinésithérapeute</th>
        <th>Jour</th>
        <th>Heure de début</th>
        <th>Heure de fin</th>
    </tr>
    @foreach($schedules as $schedule)
        <td>{{ $schedule->teacher?->name ?? 'Aucun professeur' }}</td>
        <td>{{ $schedule->date }}</td>
        <td>{{ $schedule->time_start }}</td>
        <td>{{ $schedule->time_end }}</td>
    @endforeach
</table>
</body>
</html>

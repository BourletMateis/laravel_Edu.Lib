@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Mes Horaires</h2>

        <!-- Message de succès ou d'erreur -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!--
        <form action="{{ url('schedules') }}" method="GET" class="mb-4">
            <div class="form-group">
                <label for="start_time">Heure de début</label>
                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', '07:00') }}">
            </div>
            <div class="form-group">
                <label for="end_time">Heure de fin</label>
                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time', '22:00') }}">
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour les créneaux</button>
        </form>
        -->

        <!-- Formulaire pour ajouter un horaire -->
        <h3>Ajouter un horaire</h3>
        <form action="{{ url('schedules') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="day">Jour</label>
                <select id="day" name="day" required>
                    <option value="Lundi">Lundi</option>
                    <option value="Mardi">Mardi</option>
                    <option value="Mercredi">Mercredi</option>
                    <option value="Jeudi">Jeudi</option>
                    <option value="Vendredi">Vendredi</option>
                    <option value="Samedi">Samedi</option>
                    <option value="Dimanche">Dimanche</option>
                </select>
            </div>

            <div class="form-group">
                <label for="time_start">Heure de début</label>
                <select name="time_start" id="time_start" class="form-control" required>
                    @foreach ($availableSlots as $slot)
                        <option value="{{ $slot }}">{{ $slot }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="time_end">Heure de fin</label>
                <select name="time_end" id="time_end" class="form-control" required>
                    @foreach ($availableSlots as $slot)
                        <option value="{{ $slot }}">{{ $slot }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <hr>

        <!-- Liste des horaires -->
        <h3>Mes horaires</h3>
        @foreach ($schedules as $schedule)
            <div class="schedule-item">
                <p>{{ $schedule->day }} | {{ $schedule->time_start }} - {{ $schedule->time_end }} </p>

                <form action="{{ url('schedules/' . $schedule->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
            <hr>
        @endforeach
    </div>
@endsection

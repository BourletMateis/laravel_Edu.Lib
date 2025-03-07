@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Mes Horaires</h2>

        <!-- Success or error message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Form to add a schedule -->
        <h3>Ajouter un horaire</h3>
        <form action="{{ url('schedules') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="day">Jour</label>
                <select id="day" name="day" required>
                    @foreach($days as $key => $item)
                        <option value="{{ $item }}">{{ __('pages.days.'.$item) }}</option>
                    @endforeach
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

        <!-- List of times -->
        <h3>Mes horaires</h3>
        @foreach ($schedules as $schedule)
            <div class="schedule-item">
                <p>{{ __('pages.days.'.$schedule->day) }} | {{ $schedule->time_start }} - {{ $schedule->time_end }}</p>

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

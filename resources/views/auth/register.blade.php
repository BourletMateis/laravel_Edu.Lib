@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="{{ asset('css/style_register.css') }}">
    </head>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><i class="fas fa-user-plus"></i> {{ __('Inscription') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>
                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required placeholder="Dupont" autocomplete="Nom" autofocus>
                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Prénom') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Julie" autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end"> {{ __('Adresse internet') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="julieDupont@exemple.fr" autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end"> {{ __('Mot de Passe') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="****" autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmer le Mot de Passe') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="****" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Professeur ?') }}</label>
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input class="form-check-input @error('is_teacher') is-invalid @enderror" type="radio" name="is_teacher" id="teacher_yes" value="1" {{ old('is_teacher') == '1' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="teacher_yes">Oui</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('is_teacher') is-invalid @enderror" type="radio" name="is_teacher" id="teacher_no" value="0" {{ old('is_teacher') == '0' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="teacher_no">Non, je suis apprenant</label>
                                    </div>
                                    @error('is_teacher')
                                    <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-user-check"></i> {{ __('S\'enregistrer') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

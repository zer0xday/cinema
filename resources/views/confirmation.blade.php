@extends('layouts.app')
@section('content')
    <section id="confirmation">
        <h3 class="center">Potwierdzenie</h3>
        <div class="info-container">
            <h5>Twoja rezerwacja przebiegła pomyślnie!</h5>
            <p>
                Film pt. <strong>"{{ $movie->title }}"</strong> rozpocznie się o godzinie
                <strong>{{ (new DateTime($movie->emission_time))->format('H:i') }}</strong>
            </p>
            <br>
            <span>Zarezerwowane miejsca:</span>
            <br>
            <div class="taken-places">
                @foreach ($places ?? [] as $place)
                    <div class="taken-place">
                        <span>Rząd: {{ $place['row'] }}</span>
                        <span>Numer: {{ $place['number'] }}</span>
                    </div>
                    <br>
                @endforeach
            </div>
            <br>
            <p>Kliknij <a href="{{ route('movies') }}">TUTAJ</a> aby powrócić do wyboru filmu</p>
        </div>
    </section>
@endsection

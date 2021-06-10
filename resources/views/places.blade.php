@extends('layouts.app')
@section('content')
    <section id="places-section">
        <h3 class="center">Wybierz miejsce</h3>
        <div id="legend">
            <div class="legend-item">
                <div class="available legend-colorbox"></div>
                <span>Dostępne</span>
            </div>
            <div class="legend-item">
                <div class="taken legend-colorbox"></div>
                <span>Zarezerwowane</span>
            </div>
            <div class="legend-item">
                <div class="selected legend-colorbox"></div>
                <span>Wybrane</span>
            </div>
        </div>
        <div id="places" class="center">
            @foreach($places as $rowNumber => $rowPlaces)
                <div class="places-row-container">
                    <strong class="row-number">{{ $rowNumber }}</strong>
                    <div class="places-container">
                        <div class="row place-row">
                        @foreach($rowPlaces as $place)
                            <div class="place col s1 {{ $place->taken ? 'taken' : null }}"
                                 data-row="{{ $rowNumber }}"
                                 data-place-number="{{ $place->number }}">
                                {{ $place->number }}
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="next-step">
            <form id="order-ticket" method="POST" action="{{ route('storePlaces') }}">
                @csrf
                <input type="hidden" name="places">
                <button class="btn-large waves-effect waves-light disabled" id="order-btn" type="submit" name="action">
                    Dalej
                </button>
            </form>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('content')
    <section id="order-form">
        <div class="row">
            <form class="col s6" method="POST" action="{{ route('store') }}">
                <h5>Dane zamawiającego</h5>
                @csrf
                <div class="row center-align">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="full-name" name="full_name" type="text" class="validate" required>
                        <label for="full-name">Imię i nazwisko</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input id="email" name="email" type="email" class="validate" required>
                        <label for="email">Adres email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">location_city</i>
                        <input id="city" name="city" type="text" class="validate" required>
                        <label for="city">Miasto</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">location_city</i>
                        <input id="postal-code" name="postal_code"
                               title="Zastosuj format '12-345'"
                               type="text" class="validate" required>
                        <label for="postal-code">Kod pocztowy</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">place</i>
                        <input id="address" name="address" type="text" class="validate" required>
                        <label for="address">Ulica i numer</label>
                    </div>
                </div>
                <h5>Rodzaj biletu</h5>
                @foreach ($ticketTypes as $ticketType)
                    <div class="input-field col s12">
                        <p>
                            <label>
                                <!-- TODO required attribute -->
                                <input name="ticket_type"
                                       class="with-gap"
                                       value="{{ $ticketType->id }}"
                                       data-price="{{ $ticketType->price }}"
                                       type="radio"/>
                                <span>{{ $ticketType->title }} - {{ $ticketType->price }} zł</span>
                            </label>
                        </p>
                    </div>
                @endforeach
                <h5>Metoda płatności</h5>
                @foreach ($paymentMethods as $paymentMethod)
                <div class="input-field col s12">
                    <p>
                        <label>
                            <!-- TODO required attribute -->
                            <input name="payment_method" class="with-gap" value="{{ $paymentMethod->id }}" type="radio"/>
                            <span>{{ $paymentMethod->title }}</span>
                        </label>
                    </p>
                </div>
                @endforeach
                <h5>Odbiór biletu</h5>
                @foreach ($deliveryMethods as $deliveryMethod)
                    <div class="input-field col s12">
                        <p>
                            <label>
                                <!-- TODO required attribute -->
                                <input name="delivery_method" class="with-gap"
                                       value="{{ $deliveryMethod->id }}"
                                       data-price="{{ $deliveryMethod->price }}"
                                       type="radio"/>
                                <span>
                                    {{ $deliveryMethod->title }}
                                    @if (!empty($deliveryMethod->price))
                                        (+ {{ $deliveryMethod->price }} zł)
                                    @endif
                                </span>
                            </label>
                        </p>
                    </div>
                @endforeach
                <h5>Razem: <span id="order-price">0.00</span> zł</h5>
                <input type="hidden" name="movie" value="{{ $movieData->id }}">
                <input type="hidden" name="places[]" value="{{ $placesData }}">
                <div class="next-step">
                    <button class="btn-large waves-effect waves-light center"
                            id="confirm-order"
                            type="submit"
                            name="action">
                        Zamów
                    </button>
                </div>
            </form>
            <div class="col s3 center">
                <h5>Wybrane miejsca</h5>
                @foreach ($placesData as $place)
                    <span>Rząd: {{ $place->row }}</span>,
                    <span>Miejsce nr: {{ $place->number }}</span>
                @endforeach
            </div>
            <div class="col s3 center">
                <h5>Wybrany film</h5>
                <span>{{ $movieData->title }}</span>,
                <span>godzina: {{ (new DateTime($movieData->emission_time))->format('H:i') }}</span>
            </div>
        </div>
    </section>
@endsection

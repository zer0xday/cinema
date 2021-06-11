@extends('layouts.app')
@section('content')
    <section id="order-form">
        <h3 class="center">Zamów</h3>
        <div class="row">
            <form class="col s6" method="POST" action="{{ route('storeOrder') }}">
                <h5>Dane zamawiającego</h5>
                @csrf
                <div class="row center-align">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="full-name" name="full_name" type="text" class="validate"
                               value="{{ old('full_name') }}" required>
                        <label for="full-name">Imię i nazwisko</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input id="email" name="email" type="email" class="validate"
                               value="{{ old('email') }}" required>
                        <label for="email">Adres email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">location_city</i>
                        <input id="city" name="city" type="text" class="validate"
                               value="{{ old('city') }}" required>
                        <label for="city">Miasto</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">location_city</i>
                        <input id="postal-code" name="postal_code"
                               title="Zastosuj format '12-345'"
                               type="text" class="validate"
                               pattern="[0-9]{2}-[0-9]{3}"
                               value="{{ old('postal_code') }}" required>
                        <label for="postal-code">Kod pocztowy</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">place</i>
                        <input id="address" name="address" type="text"
                               value="{{ old('address') }}" class="validate" required>
                        <label for="address">Ulica i numer</label>
                    </div>
                </div>
                <h5>Rodzaj biletu</h5>
                @foreach ($ticketTypes as $ticketType)
                    <div class="input-field col s12">
                        <p>
                            <label>
                                <input name="ticket_type"
                                       class="with-gap"
                                       value="{{ $ticketType->id }}"
                                       data-price="{{ $ticketType->price }}"
                                       type="radio"
                                       required
                                       {{ old('ticket_type') == $ticketType->id ? 'checked' : null }}/>
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
                            <input name="payment_method" class="with-gap" value="{{ $paymentMethod->id }}"
                                   type="radio"
                                   required
                                    {{ old('payment_method') == $paymentMethod->id ? 'checked' : null }}/>
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
                                <input name="delivery_method" class="with-gap"
                                       value="{{ $deliveryMethod->id }}"
                                       data-price="{{ $deliveryMethod->price }}"
                                       type="radio"
                                       required
                                        {{ old('delivery_method') == $deliveryMethod->id ? 'checked' : null }}/>
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
                <h5>Razem: <span id="order-price">{{ old('total_amount') ?? 0.00 }}</span> zł</h5>
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
                    <h5>Wybrany film</h5>
                    <br>
                    <span>{{ $movieData->title }}</span>,
                    <span>godzina: {{ (new DateTime($movieData->emission_time))->format('H:i') }}</span>
                    <br>
                    <h5>Wybrane miejsca</h5>
                    <br>
                    @foreach ($placesData as $place)
                        <div class="selected-places">
                            <span>Rząd: {{ $place['row'] }}</span>,
                            <span>Miejsce nr: {{ $place['number'] }}</span>
                        </div>
                        <br>
                    @endforeach
                </div>
        </div>
    </section>
@endsection

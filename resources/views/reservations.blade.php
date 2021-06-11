@extends('layouts.app')
@section('content')
    <section id="reservations" class="container">
        <table class="centered highlight">
            <thead>
            <tr>
                <th>Imię i nazwisko</th>
                <th>Miasto</th>
                <th>Ilość zarezerwowanych miejsc</th>
            </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->full_name }}</td>
                        <td>{{ $customer->city }}</td>
                        <td>{{ $customer->customersPlaces->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
{{--        <ul class="collection with-header black">--}}
{{--            <li class="collection-header"><h3 style="color: black">Dokonane rezerwacje</h3></li>--}}
{{--            @foreach($customers as $customer)--}}
{{--                <li class="collection-item">--}}
{{--                    {{ $customer->full_name }} - zarezerwowane miejsca: {{ $customer->customersPlaces->count() }}--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
    </section>
@endsection

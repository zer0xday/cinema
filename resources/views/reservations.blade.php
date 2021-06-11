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
    </section>
@endsection

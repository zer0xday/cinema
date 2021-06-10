@extends('layouts.app')
@section('content')
    <section class="reservations">
        <ul class="collection with-header black">
            <li class="collection-header"><h3 style="color: black">Dokonane rezerwacje</h3></li>
            @foreach($customers as $customer)
                <li class="collection-item">
                    {{ $customer->full_name }} - zarezerwowane miejsca: {{ $customer->customersPlaces->count() }}
                </li>
            @endforeach
        </ul>
    </section>
@endsection

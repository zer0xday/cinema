@extends('layouts.app')
@section('content')
    <section class="movies-container">
        <form action="{{ route('places') }}" method="POST">
            @csrf
            @foreach ($movies as $movie)
                <p class="center">
                    <label>
                        <input name="movie" class="with-gap" value="{{ $movie->id }}" type="radio" required/>
                        <span>{{ $movie->title }} - {{ (new DateTime($movie->emission_time))->format('H:i') }}</span>
                    </label>
                </p>
            @endforeach
            <div class="next-step">
                <button class="btn-large waves-effect waves-light" type="submit" name="action">
                    Dalej
                </button>
            </div>
        </form>
    </section>
@endsection

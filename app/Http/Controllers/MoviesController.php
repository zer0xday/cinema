<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MoviesController extends Controller
{
    protected Movie $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function index(Request $request): View
    {
        $request->session()->forget(['movies', 'places']);

        return view('movies', [
            'movies' => $this->movie->all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate(['movie' => ['required', 'numeric']]);
        $this->movie->findOrFail($validatedData['movie']);

        $request->session()->put('movie', $validatedData['movie']);

        return redirect()->route('places');
    }
}

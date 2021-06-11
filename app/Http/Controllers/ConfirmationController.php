<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    protected Movie $movie;

    public function __construct(
        Movie $movie
    )
    {
        $this->movie = $movie;
    }

    public function index(Request $request)
    {
        $movieId = $request->session()->get('movie');
        $places = $request->session()->get('places');
        $movieData = $this->movie->findOrFail($movieId);

        $request->session()->forget(['movie', 'places']);

        return view('confirmation', [
            'movie' => $movieData,
            'places' => $places
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CustomerPlace;
use App\Models\Place;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    protected Place $place;

    protected CustomerPlace $customerPlace;

    public function __construct(
        Place $place,
        CustomerPlace $customerPlace
    )
    {
        $this->place = $place;
        $this->customerPlace = $customerPlace;
    }

    public function index(): View
    {
        $places = $this->place->all()->groupBy('row');

        foreach ($places as $placesInRow) {
            foreach ($placesInRow as $place) {
                $place->taken = $this->customerPlace->alreadyTakenById($place->id);
            }
        }

        return view('places', [
            'places' => $places
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate(['places' => ['required']]);

        $places = $this->place->fetchPlaces($validatedData);

        if ($this->customerPlace->alreadyTaken($places)) {
            return back()->withErrors(__('Jedno bądź kilka miejsc, które wybrałeś zostały już zajęte'));
        }

        $request->session()->put('places', $places);

        return redirect()->route('order');
    }
}

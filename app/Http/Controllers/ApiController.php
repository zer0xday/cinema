<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

class ApiController extends Controller
{
    // todo sprawdzanie czy miejsce jest zajęte
    public function placeAvailability()
    {
        return ['msg' => 'test'];
    }
}

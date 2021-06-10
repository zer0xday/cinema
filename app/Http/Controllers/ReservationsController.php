<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Contracts\View\View;

class ReservationsController extends Controller
{
    protected Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function index(): View
    {
        return view('reservations', [
            'customers' => $this->customer->all()
        ]);
    }
}

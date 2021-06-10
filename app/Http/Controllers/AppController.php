<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DeliveryMethod;
use App\Models\Movie;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Place;
use App\Models\TicketType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AppController extends Controller
{
    private const STORE_VALIDATION_RULES = [
        'full_name' => ['required'],
        'email' => ['required', 'email'],
        'city' => ['required'],
        'address' => ['required'],
        'postal_code' => ['required', 'regex:/[0-9]{2}-[0-9]{3}/'],
        'payment_method' => ['required'],
        'ticket_type' => ['required'],
        'delivery_method' => ['required'],
        'movie_id' => ['required'], //todo temp
        'places' => ['required'] //todo temp unique bedzie mozna zastosować do places
    ];

    protected Place $place;

    protected Movie $movie;

    protected PaymentMethod $paymentMethod;

    protected DeliveryMethod $deliveryMethod;

    protected TicketType $ticketType;

    protected Customer $customer;

    protected Order $order;

    public function __construct(
        Place $place,
        Movie $movie,
        PaymentMethod $paymentMethod,
        DeliveryMethod $deliveryMethod,
        TicketType $ticketType,
        Customer $customer,
        Order $order
    )
    {
        $this->place = $place;
        $this->movie = $movie;
        $this->paymentMethod = $paymentMethod;
        $this->deliveryMethod = $deliveryMethod;
        $this->ticketType = $ticketType;
        $this->customer = $customer;
        $this->order = $order;
    }

    public function movies(): View
    {
        return view('movies', [
            'movies' => $this->movie->all()
        ]);
    }

    public function places(Request $request): View
    {
        $request->session()->reflash();
        // trzeba te dane zapisywać w sesji - nie polegać na hidden inputach - zbyt ryzykowne

        $validatedData = $request->validate(['movie' => ['required']]);

        return view('places', [
            'movie' => $validatedData['movie'],
            'places' => $this->place->all()->groupBy('row')
        ]);
    }

    public function order(Request $request): View
    {
        $movieData = $this->movie->find($request->input('movie'));
        $placesData = $this->place
            ->where('row', $request->input('row'))
            ->where('number', $request->input('place_number'))
            ->get(); // todo obsluzyc kilka zarezerwowanych miejsc (jak bedzie czas)

        return view('order', [
            'movieData' => $movieData,
            'placesData' => $placesData,
            'ticketTypes' => $this->ticketType->all(),
            'paymentMethods' => $this->paymentMethod->all(),
            'deliveryMethods' => $this->deliveryMethod->all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->all();

            $customerData = $this->customer->fetchCustomerData($validatedData);

            $this->customer->fill($customerData)->save();
            $customerId = $this->customer->id;

            $orderData = $this->order->fetchOrderData($validatedData);
            $orderData['customer_id'] = $customerId;

            dd($orderData);

            $this->order->fill($orderData)->save();
        } catch (\Exception $exception) {
            return $exception->getTrace();
        }
    }
}

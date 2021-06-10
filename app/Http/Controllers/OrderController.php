<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerPlace;
use App\Models\DeliveryMethod;
use App\Models\Movie;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Place;
use App\Models\TicketType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected Place $place;

    protected Movie $movie;

    protected PaymentMethod $paymentMethod;

    protected DeliveryMethod $deliveryMethod;

    protected TicketType $ticketType;

    protected Customer $customer;

    protected Order $order;

    protected CustomerPlace $customerPlace;

    public function __construct(
        Place $place,
        Movie $movie,
        PaymentMethod $paymentMethod,
        DeliveryMethod $deliveryMethod,
        TicketType $ticketType,
        Customer $customer,
        Order $order,
        CustomerPlace $customerPlace
    )
    {
        $this->place = $place;
        $this->movie = $movie;
        $this->paymentMethod = $paymentMethod;
        $this->deliveryMethod = $deliveryMethod;
        $this->ticketType = $ticketType;
        $this->customer = $customer;
        $this->order = $order;
        $this->customerPlace = $customerPlace;
    }

    public function index(Request $request): View
    {
        $movieId = $request->session()->get('movie');
        $placesData = $request->session()->get('places');

        return view('order', [
            'movieData' => $this->movie->findOrFail($movieId),
            'placesData' => $placesData,
            'ticketTypes' => $this->ticketType->all(),
            'paymentMethods' => $this->paymentMethod->all(),
            'deliveryMethods' => $this->deliveryMethod->all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate(Order::STORE_ORDER_RULES);
        $validatedData['movie'] = $request->session()->get('movie');

        try {
            DB::beginTransaction();

            $customerData = $this->customer->fetchCustomerData($validatedData);
            $this->customer->fill($customerData)->save();
            $places = $request->session()->get('places');

            if ($this->customerPlace->alreadyTaken($places)) {
                return back()
                    ->withErrors(__('Jedno bądź kilka miejsc, które wybrałeś zostały już zajęte'))
                    ->withInput();
            }

            foreach ($places as $place) {
                $customerPlaces = new CustomerPlace;
                $customerPlaces->customer_id = $this->customer->id;
                $placeModel = $this->place->getPlace($place);
                $customerPlaces->place_id = $placeModel['id'];
                $customerPlaces->save();
            }

            $orderData = $this->order->fetchOrderData($validatedData, count($places));

            $newOrder = new Order;
            $newOrder->customer_id = $this->customer->id;
            $newOrder->fill($orderData)->save();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()
                ->withErrors(__('Coś poszło nie tak, proszę spróbować ponownie'))
                ->withInput();
        }

        return redirect()->route('confirmation');
    }
}

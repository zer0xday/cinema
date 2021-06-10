<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\ClassString;

class Order extends Model
{
    use HasFactory;

    const STORE_ORDER_RULES = [
        'full_name' => ['required'],
        'email' => ['required', 'email'],
        'city' => ['required'],
        'address' => ['required'],
        'postal_code' => ['required', 'regex:/[0-9]{2}-[0-9]{3}/'],
        'payment_method' => ['required', 'numeric'],
        'ticket_type' => ['required', 'numeric'],
        'delivery_method' => ['required', 'numeric']
    ];

    protected $table = 'orders';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $guarded = ['id'];

    public function fetchOrderData(array $validatedData, int $placesQty): array
    {
        $orderData = [];
        $orderData['payment_method_id'] = $this->validateExistence(
            PaymentMethod::class, $validatedData, 'payment_method'
        );
        $orderData['delivery_method_id'] = $this->validateExistence(
            DeliveryMethod::class, $validatedData, 'delivery_method'
        );
        $orderData['movie_id'] = $this->validateExistence(
            Movie::class, $validatedData, 'movie'
        );
        $orderData['ticket_type_id'] = $this->validateExistence(
            TicketType::class, $validatedData, 'ticket_type'
        );
        $orderData['total_amount'] = $this->calculateTotalAmount($validatedData, $placesQty);
        $orderData['completed'] = $this->isOrderCompleted($validatedData);

        return $orderData;
    }

    protected function isOrderCompleted(array $validatedData): bool
    {
        $data = PaymentMethod::query()->findOrFail($validatedData['payment_method']);

        return $data['title'] === PaymentMethod::TRANSFER_PAYMENT_METHOD;
    }

    protected function calculateTotalAmount(array $validatedData, int $placesQty): string
    {
        $deliveryMethodPrice = $this->getRawPrice(DeliveryMethod::class, $validatedData, 'delivery_method');
        $ticketTypePrice = $this->getRawPrice(TicketType::class, $validatedData, 'ticket_type');
        $operation = ($placesQty * $ticketTypePrice) + $deliveryMethodPrice;

        return number_format($operation, 2);
    }

    protected function getRawPrice(string $model, array $validatedData, string $key): float
    {
        /** @var Model $model */
        $data = $model::query()->findOrFail($validatedData[$key]);

        return $data['price'] ?? 0.00;
    }

    protected function validateExistence(string $model, array $validatedData, string $value): string|int
    {
        if (empty($validatedData[$value])) {
            throw new \UnexpectedValueException(__('Wprowadzona wartość jest niepoprawna'));
        }

        /** @var Model $model */
        $exists = $model::query()->find($validatedData[$value])->exists();

        if (!$exists) {
            throw new \UnexpectedValueException(__('Wprowadzona wartość jest niepoprawna'));
        }

        return $validatedData[$value];
    }
}

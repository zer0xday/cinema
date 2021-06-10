<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\ClassString;

class Order extends Model
{
    use HasFactory;

    private const TRANSFER_PAYMENT_METHOD = 'Przelew';

    protected $table = 'orders';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $fillable = ['*'];

    public function fetchOrderData(array $validatedData): array
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
        $orderData['total_amount'] = $this->calculateTotalAmount($validatedData);
        $orderData['completed'] = $this->isOrderCompleted($validatedData);

        return $orderData;
    }

    protected function isOrderCompleted(array $validatedData): bool
    {
        $data = PaymentMethod::query()->findOrFail($validatedData['payment_method']);

        return $data['title'] === self::TRANSFER_PAYMENT_METHOD;
    }

    protected function calculateTotalAmount(array $validatedData): string
    {
        $deliveryMethodPrice = $this->getRawPrice(DeliveryMethod::class, $validatedData, 'delivery_method');
        $ticketTypePrice = $this->getRawPrice(TicketType::class, $validatedData, 'ticket_type');

        return number_format(($deliveryMethodPrice + $ticketTypePrice), 2);
    }

    protected function getRawPrice(string $model, array $validatedData, string $key): float
    {
        /** @var Model $model */
        $data = $model::query()->findOrFail($validatedData[$key]);

        return $data['price'] ?? 0.00;
    }

    protected function validateExistence(string $model, array $validatedData, string $value): string|int
    {
        /** @var Model $model */
        $exists = $model::query()->find($validatedData[$value])->exists();

        if (!$exists) {
            throw new \UnexpectedValueException(__('Wprowadzona wartość jest niepoprawna'));
        }

        return $validatedData[$value];
    }
}

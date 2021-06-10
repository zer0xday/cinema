<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = ['full_name', 'email', 'city', 'address', 'postal_code'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function customersPlaces(): HasMany
    {
        return $this->hasMany(CustomerPlace::class, 'customer_id', 'id');
    }

    public function fetchCustomerData(array $validatedData): array
    {
        $customerData = [];

        foreach ($this->fillable as $columnName) {
            $customerData[$columnName] = $validatedData[$columnName] ?? null;
        }

        return $customerData;
    }
}

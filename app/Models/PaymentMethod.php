<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    const TRANSFER_PAYMENT_METHOD = 'Przelew';

    protected $table = 'payment_methods';
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use HasFactory;

    protected $table = 'delivery_methods';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
}

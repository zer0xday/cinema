<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPlace extends Model
{
    use HasFactory;

    protected $table = 'customers_places';
    public $timestamps = false;
}

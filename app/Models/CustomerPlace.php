<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPlace extends Model
{
    use HasFactory;

    protected $table = 'customers_places';
    public $timestamps = false;
    protected $guarded = ['customer_id', 'place_id'];

    public function alreadyTaken(array $places): bool
    {
        foreach ($places as $place) {
            $placeModel = Place::query()
                ->where('number', '=', $place['number'])
                ->where('row', '=', $place['row'])
                ->first();
            $alreadyTaken = $this->where('place_id', '=', $placeModel['id'])->exists();

            if ($alreadyTaken) {
                return true;
            }
        }

        return false;
    }

    public function alreadyTakenById(int $placeId): bool
    {
        return $this->where('place_id', '=', $placeId)->exists();
    }
}

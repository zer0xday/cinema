<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';
    public $timestamps = false;

    public function fetchPlaces(array $validatedData): array
    {
        $data = explode(',', $validatedData['places']);
        $places = [];

        foreach ($data as $i => $placeString) {
            $explodedPlace = explode(':', $placeString);
            $places[$i]['row'] = $explodedPlace[0];
            $places[$i]['number'] = $explodedPlace[1];
        }

        return $places;
    }

    public function getPlace(array $placeData)
    {
        /** @var Model $this */
        return $this
            ->where('number', '=', $placeData['number'])
            ->where('row', '=', $placeData['row'])
            ->first();
    }
}

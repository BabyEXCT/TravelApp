<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $fillable = [
        'package_id', 'slot_number', 'available_slots', 'price'
    ];

    // Relationship to the Package model
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

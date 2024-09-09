<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'payment_id',
        'user_id',
        'package_id',
        'amount',
        'invoice_number',
        'status',
        'invoice_date',
    ];

    // Define relationships if needed
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function getErrors()
    {
        return $this->errors ?? [];
    }

}



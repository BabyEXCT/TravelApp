<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'package_id',
        'amount',
        'payment_method',
        'invoice_number',
        'payment_date',
    ];
    /**
     * Get the bookings for the package.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the vendor that offers the package.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

       // Relationship to the Slot model
       public function slots()
       {
           return $this->hasMany(Slot::class);
       }
       public function invoices()
{
    return $this->hasMany(Invoice::class);
}


    // Add any other relationships and methods relevant to your application
}

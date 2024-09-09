<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'amount',
        'payment_method',
        'invoice_number',
        'payment_date',
    ];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

}


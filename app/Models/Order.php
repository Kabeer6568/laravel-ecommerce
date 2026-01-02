<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [

        'first_name',
        'last_name',
        'email',
        'phone_no',
        'address',
        'country',
        'city',
        'state',
        'zipcode',
        'total_amount',      
        'status',            
        'payment_method',

    ];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}

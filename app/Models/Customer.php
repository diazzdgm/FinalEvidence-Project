<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable=[
        'Name',
        'Email',
        'Phone'
    ];

    /**
     * Get the orders for the customer.
     */
    public function orders()
    {
        // Asumiendo que la clave foránea en la tabla 'orders' es 'Customer_ID'
        return $this->hasMany(Order::class, 'Customer_ID');
    }
}

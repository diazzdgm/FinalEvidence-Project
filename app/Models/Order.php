<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable=[
        'Status',
        'User_ID',
        'Customer_ID',
        'label_image_path', // <-- Corregido para coincidir con la base de datos y el controlador
    ];
}

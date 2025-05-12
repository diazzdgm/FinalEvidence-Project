<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryMovement extends Model
{
    use HasFactory;
    protected $table = 'inventory_movement';
    protected $fillable=[
        'Product_ID',
        'Movement_Type',
        'Quantity',
        'User_ID'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable=[
        'Name',
        'Description',
        'Unit_Price',
        'Stock',
        'Warehouse',
        'Category_ID'
    ];

    /**
     * Get the inventory movements for the product.
     */
    public function inventoryMovements()
    {
        // Asumiendo que la clave foránea en la tabla 'inventory_movement' es 'Product_ID'
        return $this->hasMany(InventoryMovement::class, 'Product_ID');
    }
}

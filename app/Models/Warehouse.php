<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class Warehouse extends Model
{
    use HasFactory;
    protected $table = 'werehouse';
    protected $fillable=[
        'Name'
    ];

    /**
     * Get the products for the warehouse.
     */
    public function products()
    {
        // La clave foránea en la tabla 'product' es 'Warehouse'
        return $this->hasMany(Product::class, 'Warehouse');
    }
}

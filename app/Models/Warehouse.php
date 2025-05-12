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
}

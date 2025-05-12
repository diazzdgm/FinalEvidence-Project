<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $fillable=[
        'Name',
        'Description'
    ];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        // Asumiendo una tabla pivote 'role_user' y claves foráneas convencionales
        return $this->belongsToMany(User::class);
    }
}

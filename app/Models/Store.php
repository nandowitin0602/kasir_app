<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $primaryKey = 'store_id'; // Custom primary key

    protected $fillable = ['store_name', 'store_address'];

    public function users()
    {
        return $this->hasMany(User::class, 'store_id', 'store_id'); // Relasi ke users
    }
}

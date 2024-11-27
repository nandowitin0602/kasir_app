<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id'; // Custom primary key

    // Nama tabel yang digunakan
    protected $table = 'items';

    // Kolom-kolom yang dapat diisi mass-assignment
    protected $fillable = [
        'item_code',
        'item_name',
        'item_price',
        'stock',
        'selling_unit',
        'is_deleted',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'item_id', 'item_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $primaryKey = 'transaction_detail_id';
    protected $fillable = ['transaction_id', 'item_id', 'quantity', 'total_price'];

    public $timestamps = false;

    // Relasi ke model Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    // Relasi ke model Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }
}

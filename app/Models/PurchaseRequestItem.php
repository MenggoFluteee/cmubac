<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequestItem extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_request_id', 'item_id', 'status', 'january_quantity', 'february_quantity', 'march_quantity', 'april_quantity', 'may_quantity', 'june_quantity', 'july_quantity', 'august_quantity', 'september_quantity', 'october_quantity', 'november_quantity', 'december_quantity'];

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class, 'purchase_request_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}

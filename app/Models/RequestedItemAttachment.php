<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedItemAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['requested_item_id', 'company_name', 'company_contact_no', 'item_price', 'file_path', 'is_selected'];


    public function requestedItem()
    {
        return $this->belongsTo(RequestedItem::class, 'requested_item_id', 'id');
    }
}

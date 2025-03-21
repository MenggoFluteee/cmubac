<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    //

    protected $fillable = [
        'item_category_name',
        'item_category_code',
        'item_category_description'
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'item_category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_name',
        'item_code',
        'item_description',
        'unit_of_measure',
        'is_available',
        'is_psdbm',
        'item_category_id',
        'account_code_id',
        'added_by',
        'is_psdbm_approved',
        'approved_by'
    ];

    public function itemCategory()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id', 'id');
    }

    public function prices()
    {
        return $this->hasMany(ItemPrice::class, 'item_id');
    }

    public function accountCode()
    {
        return $this->belongsTo(AccountCode::class, 'account_code_id', 'id');
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}

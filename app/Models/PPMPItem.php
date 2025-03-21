<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPMPItem extends Model
{
    use HasFactory;

    protected $fillable = ['ppmp_id', 'item_id', 'january_quantity', 'february_quantity', 'march_quantity', 'april_quantity', 'may_quantity', 'june_quantity', 'july_quantity', 'august_quantity', 'september_quantity', 'october_quantity', 'november_quantity', 'december_quantity'];


    public function ppmp()
    {
        return $this->belongsTo(PPMP::class, 'ppmp_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}

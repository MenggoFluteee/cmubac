<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPMP extends Model
{
    //

    protected $fillable = ['budget_allocation_id', 'created_by', 'ppmp_code', 'is_submitted', 'incrementing_number', 'approval_status'];

    public function budgetAllocation()
    {
        return $this->belongsTo(BudgetAllocation::class, 'budget_allocation_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function ppmpComments()
    {
        return $this->hasMany(PPMPComment::class, 'ppmp_id');
    }

    public function ppmpItems()
    {
        return $this->hasMany(PPMPItem::class, 'ppmp_id');
    }
}

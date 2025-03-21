<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WholeBudget extends Model
{
    //

    protected $fillable = ['id', 'amount', 'year', 'source_of_fund', 'type_of_budget'];

    public function budgetAllocations()
    {
        return $this->hasMany(BudgetAllocation::class, 'whole_budget_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountCode extends Model
{
    protected $fillable = [
        'account_code',
        'account_name',
    ];

    public function budgetAllocations()
    {
        return $this->hasMany(BudgetAllocation::class, 'account_code_id');
    }
}

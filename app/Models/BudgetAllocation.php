<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetAllocation extends Model
{
    protected $fillable = [
        'college_office_unit_id', 
        'whole_budget_id', 
        'amount', 
        'allocated_by', 
        'account_code_id', 
        'date_allocated',
    ];

    public function collegeOfficeUnit()
    {
        return $this->belongsTo(CollegeOfficeUnit::class, 'college_office_unit_id', 'id');
    }

    public function wholeBudget()
    {
        return $this->belongsTo(WholeBudget::class, 'whole_budget_id', 'id');
    }

    public function allocatedBy()
    {
        return $this->belongsTo(User::class, 'allocated_by', 'id');
    }

    public function accountCode()
    {
        return $this->belongsTo(AccountCode::class, 'account_code_id', 'id');
    }
}

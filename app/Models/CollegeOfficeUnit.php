<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeOfficeUnit extends Model
{
    protected $fillable = [
        'college_office_unit_name',
        'category_id',
        'college_office_unit_image_path',
        'acronym',
    ];

    public function category()
    {
        return $this->belongsTo(CollegeOfficeUnitCategory::class, 'category_id', 'id');
    }

    public function budgetAllocations()
    {
        return $this->hasMany(BudgetAllocation::class, 'college_office_unit_id', 'id');
    }
}

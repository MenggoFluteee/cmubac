<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeOfficeUnitCategory extends Model
{
    //

    protected $fillable = ['category_name'];

    public function collegeOfficeUnits()
    {
        return $this->hasMany(CollegeOfficeUnit::class, 'college_office_unit_id');
    }
}

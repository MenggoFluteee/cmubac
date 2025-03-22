<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $table = 'purchase_requests';
    
    protected $fillable = ['pr_code', 'ppmp_id', 'purpose', 'is_submitted', 'date_submitted', 'approval_status', 'date_approved', 'prepared_by', 'college_office_unit_id', 'incrementing_number'];

    public function ppmp()
    {
        return $this->belongsTo(PPMP::class, 'ppmp_id', 'id');
    }

    public function preparedBy()
    {
        return $this->belongsTo(User::class, 'prepared_by', 'id');
    }

    public function collegeOfficeUnit()
    {
        return $this->belongsTo(CollegeOfficeUnit::class, 'college_office_unit_id', 'id');
    }
}

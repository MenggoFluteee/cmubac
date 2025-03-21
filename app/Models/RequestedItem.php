<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedItem extends Model
{
    use HasFactory;

    protected $fillable = ['item_name', 'item_description', 'unit_of_measure', 'approval_status', 'college_office_unit_id', 'created_by'];


    public function collegeOfficeUnit()
    {
        return $this->belongsTo(CollegeOfficeUnit::class, 'college_office_unit_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function requestedItemAttachments()
    {
        return $this->hasMany(RequestedItemAttachment::class, 'requested_item_id');
    }
}

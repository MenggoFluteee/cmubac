<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPMPComment extends Model
{
    use HasFactory;

    protected $fillable = ['ppmp_id', 'comment', 'from_user'];

    public function ppmp()
    {
        return $this->belongsTo(PPMP::class, 'ppmp_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user', 'id');
    }
}

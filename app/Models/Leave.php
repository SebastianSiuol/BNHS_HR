<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function leave_types(){
        return $this->belongsTo(LeaveType::class);
    }
}

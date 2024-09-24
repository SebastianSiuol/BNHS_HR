<?php

namespace App\Models\FacultyAccountInformation;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentStatus extends Model
{
    use HasFactory;

    public function faculties(){
        return $this->hasMany(Faculty::class);
    }
}

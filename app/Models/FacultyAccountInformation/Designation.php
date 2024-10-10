<?php

namespace App\Models\FacultyAccountInformation;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'department_id'];

    public function faculties(){
        return $this->hasMany(Faculty::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

}

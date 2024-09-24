<?php

namespace App\Models\FacultyAccountInformation;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function faculties(){
        return $this->hasMany(Faculty::class);
    }
}

<?php

namespace App\Models\FacultyAccountInformation;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function designations(){
        return $this->hasMany(Designation::class);
    }
}

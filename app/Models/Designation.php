<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = ['department_designation'];

    public function faculties(){
        return $this->hasMany(Faculty::class);
    }

}

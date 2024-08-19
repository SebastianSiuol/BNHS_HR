<?php

namespace App\Models\FacultyInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    use HasFactory;

    protected $table = 'citizenships';

    public function personal_information()
    {
        return $this->hasOne(PersonalInformation::class);
    }
}

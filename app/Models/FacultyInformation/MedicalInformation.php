<?php

namespace App\Models\FacultyInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInformation extends Model
{
    use HasFactory;

    protected $table = 'medical_information';

    public function personal_information()
    {
        return $this->belongsTo(PersonalInformation::class);
    }
}

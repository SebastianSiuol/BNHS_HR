<?php

namespace App\Models\PersonalInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInformation extends Model
{
    use HasFactory;

    protected $table = 'medical_information';
    protected $guarded = [];



    public function personal_information()
    {
        return $this->belongsTo(PersonalInformation::class);
    }
}

<?php

namespace App\Models\FacultyInformation;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $table = 'personal_information';

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function medical_info(){
        return $this->hasOne(MedicalInformation::class);
    }

    public function phil_id_cards()
    {
        return $this->hasOne(PhilippinesIdentificationCards::class);
    }

    public function civilstatus()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function citizenship(){
        return $this->belongsTo(Citizenship::class);
    }

    public function address(){
        return $this->hasOne(Address::class);
    }
}

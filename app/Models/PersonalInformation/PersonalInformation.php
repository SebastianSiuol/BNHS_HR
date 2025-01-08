<?php

namespace App\Models\PersonalInformation;

use App\Models\CivilService;
use App\Models\Faculty;
use App\Models\LearningAndDevelopment;
use App\Models\OtherInformation;
use App\Models\VoluntaryWork;
use App\Models\WorkExperience;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'personal_information';

    public function generateFullName(){
        return $this->first_name . ' ' . $this->last_name;
    }

//  NOTE: HAS ONE RELATIONSHIPS (Foreign Key is in Their Table)
    public function medical_info(){
        return $this->hasOne(MedicalInformation::class);
    }

    public function phil_id_cards()
    {
        return $this->hasOne(PhilippinesIdentificationCards::class);
    }

    public function residentiaL_address(){
        return $this->hasOne(ResidentialAddress::class);
    }

    public function permanent_address(){
        return $this->hasOne(PermanentAddress::class);
    }

    public function contact_person(){
        return $this->hasOne(ContactPerson::class);
    }

    public function civil_services(){
        return $this->hasMany(CivilService::class);
    }

    public function work_experiences(){
        return $this->hasMany(WorkExperience::class);
    }

    public function voluntary_works(){
        return $this->hasMany(VoluntaryWork::class);
    }

    public function learning_and_developments(){
        return $this->hasMany(LearningAndDevelopment::class);
    }

    public function other_information(){
        return $this->hasMany(OtherInformation::class);
    }

//  NOTE: HAS MANY RELATIONSHIPS
    public function reference_members(){
        return $this->hasMany(ReferenceMember::class);
    }


//    NOTE: BELONGS TO RELATIONSHIPS (Foreign Key is in The Table)
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function name_extension() {
        return $this->belongsTo(NameExtension::class);
    }

    public function civil_status()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function citizenship(){
        return $this->belongsTo(Citizenship::class);
    }


//   NOTE: Methods
    public function getFirstRefMember(){
        return $this->reference_members()->where('reference_number', 1);
    }

    public function getSecondRefMember(){
        return $this->reference_members()->where('reference_number', 2);
    }
}

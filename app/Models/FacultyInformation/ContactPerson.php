<?php

namespace App\Models\FacultyInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function personal_information(){
        return $this->belongsTo(PersonalInformation::class);
    }
}

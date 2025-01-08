<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PersonalInformation\PersonalInformation;
use Illuminate\Database\Eloquent\Model;

class VoluntaryWork extends Model
{
    /** @use HasFactory<\Database\Factories\VoluntaryWorkFactory> */
    use HasFactory;

    protected $guarded = [];


    public function personal_information(){
        return $this->belongsTo(PersonalInformation::class);
    }
}

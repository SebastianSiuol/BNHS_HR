<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PersonalInformation\PersonalInformation;

class CivilService extends Model
{
    /** @use HasFactory<\Database\Factories\CivilServiceFactory> */
    use HasFactory;

    protected $guarded = [];

//    NOTE: BELONGS TO RELATIONSHIPS (Foreign Key is in The Table)
    public function personal_information(){
        return $this->belongsTo(PersonalInformation::class);
    }
}

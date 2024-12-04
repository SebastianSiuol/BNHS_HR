<?php

namespace App\Models\PersonalInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameExtension extends Model
{
    use HasFactory;

    public function personal_information(){
        return $this->hasOne(PersonalInformation::class);
    }
}

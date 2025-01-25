<?php

namespace App\Models\PersonalInformation;

use App\Models\ParentMember;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameExtension extends Model
{
    use HasFactory;

    public function personal_information(){
        return $this->hasOne(PersonalInformation::class);
    }

    public function spouse(){
        return $this->hasOne(SpouseMember::class);
    }

    public function parent(){
        return $this->hasOne(ParentMember::class);
    }
}

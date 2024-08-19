<?php

namespace App\Models\FacultyInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';

    public function personal_information(){
        return $this->belongsTo(PersonalInformation::class);
    }
}

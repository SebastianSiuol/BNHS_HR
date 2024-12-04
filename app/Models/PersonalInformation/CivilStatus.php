<?php

namespace App\Models\PersonalInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    use HasFactory;

    protected $fillable = ['civil_status'];

    protected $table = 'civil_status';

    public function personal_information()
    {
        return $this->hasOne(PersonalInformation::class);
    }
}

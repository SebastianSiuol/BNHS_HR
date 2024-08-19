<?php

namespace App\Models\FacultyInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippinesIdentificationCards extends Model
{
    use HasFactory;

    protected $table = 'phil_id_cards';

    public function personal_information()
    {
        return $this->belongsTo(PersonalInformation::class);
    }
}

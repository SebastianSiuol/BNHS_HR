<?php

namespace App\Models;

use App\Models\FacultyInformation\PersonalInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceMember extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact_number', 'address', 'reference_number'];

    public function personal_information(){
        return $this->belongsTo(PersonalInformation::class);
    }
}

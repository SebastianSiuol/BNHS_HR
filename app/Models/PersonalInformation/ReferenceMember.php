<?php

namespace App\Models\PersonalInformation;

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PersonalInformation\PersonalInformation;
use Illuminate\Database\Eloquent\Model;

class LearningAndDevelopment extends Model
{
    /** @use HasFactory<\Database\Factories\LearningAndDevelopmentFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $table = 'learning_and_developments';


    public function personal_information(){
        return $this->belongsTo(PersonalInformation::class);
    }
}

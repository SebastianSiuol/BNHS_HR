<?php

namespace App\Models\Configuration;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolPosition extends Model
{
    use HasFactory;

    protected $table = 'school_positions';

    public function positionLevel (){
        switch($this->level){
            case "leadership":
                return "Leadership";
            case "entry":
                return "Entry-Level";
            case "mid":
                return "Mid-Level";
            case "senior":
                return "Senior-Level";
            case "support":
                return "Support Staff";
            case "it":
                return "IT Staff";
        };
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }
}

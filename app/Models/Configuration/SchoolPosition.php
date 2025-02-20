<?php

namespace App\Models\Configuration;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SchoolPosition extends Model
{
    use HasFactory;

    protected $table = 'school_positions';

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->public_id)) {
                $model->public_id = (string) Str::uuid();
            }
        });
    }

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

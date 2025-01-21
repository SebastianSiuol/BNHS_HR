<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PersonalInformation\PersonalInformation;
use Illuminate\Support\Str;

class EducationalBackground extends Model
{
    /** @use HasFactory<\Database\Factories\EducationalBackgroundFactory> */
    use HasFactory;

    protected $guarded = [];

    protected static function boot() : void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->public_id)) {
                $model->public_id = (string) Str::uuid();
            }
        });
    }

    public function personal_information(){
        return $this->belongsTo(PersonalInformation::class);
    }
}

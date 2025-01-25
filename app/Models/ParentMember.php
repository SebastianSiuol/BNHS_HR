<?php

namespace App\Models;

use App\Models\PersonalInformation\NameExtension;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PersonalInformation\PersonalInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ParentMember extends Model
{
    /** @use HasFactory<\Database\Factories\ParentMemberFactory> */
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

    public function name_extension() {
        return $this->belongsTo(NameExtension::class);
    }
}

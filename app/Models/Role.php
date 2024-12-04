<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function getName(){
        $separated =  explode("_", $this->role_name);

        $industry = strtoupper($separated[0]);
        $module = ucfirst($separated[1]);

        return $industry . ' - ' . $module;
    }

    public function faculties(){
        return $this->belongsToMany(Faculty::class)->withTimestamps();
    }
}

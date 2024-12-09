<?php

namespace App\Models;

use App\Models\Configuration\SchoolPosition;
use App\Models\FacultyAccountInformation\Designation;
use App\Models\FacultyAccountInformation\EmploymentStatus;
use App\Models\PersonalInformation\PersonalInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Faculty extends Authenticatable implements JWTSubject
{
//    use HasApiTokens ,HasFactory, Notifiable;
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'date_of_joining',
        'date_of_leaving',
        'department_id',
        'designation_id',
        'shift_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['personal_information'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected static function boot() : void
    {
        parent::boot();

        static::creating(function ($faculty) {
            $faculty->faculty_code = Faculty::generateFacultyCode();
            $faculty->password = "Password123";
        });
    }

    public static function generateFacultyCode()
    {
        // Set the prefix for the ID
        $prefix = 'BHNHS-';
        // Get the current year
        $year = date('Y');

        // Fetch the last faculty record for the current year
        $lastFaculty = Faculty::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        // Determine the next number in the sequence
        if ($lastFaculty) {
            // Extract the numeric part of the last ID
            $lastIdNumber = (int) substr($lastFaculty->faculty_code, -4);
            $nextIdNumber = $lastIdNumber + 1;
        } else {
            $nextIdNumber = 1;
        }

        // Pad the number with leading zeros to make it four digits
        $formattedNumber = str_pad($nextIdNumber, 4, '0', STR_PAD_LEFT);

        // Combine everything into the final code
        return $prefix . $year . '-' . $formattedNumber;
    }

    public function checkRoles()
    {
        $has_sis = false;
        $has_logi = false;

        foreach ($this->roles()->pluck('role_name') as $role) {
            $separated = explode("_", $role);

            if($separated[0] == "sis"){
                $has_sis = true;
            };

            if($separated[0] == "logi"){
                $has_logi = true;
            };
        }

        return [
            'has_sis' => $has_sis,
            'has_logi' => $has_logi,
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    /* NOTE: HasOne/Many Relationships */
    public function personal_information(){
        return $this->hasOne(PersonalInformation::class);
    }

    public function comment(){
        return $this->hasOne(Comment::class);
    }

    public function leaves(){
        return $this->hasMany(Leave::class);
    }

    public function rpms(){
        return $this->hasMany(RPMS::class);
    }

    /* NOTE: Belongs Relationships */

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public function shift(){
        return $this->belongsTo(Shift::class);
    }

    public function employment_status()
    {
        return $this->belongsTo(EmploymentStatus::class);
    }

    public function school_position()
    {
        return $this->belongsTo(SchoolPosition::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}

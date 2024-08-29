<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\FacultyInformation\PersonalInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Faculty extends Authenticatable
{
    use HasApiTokens ,HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'department_id',
        'designation_id',
        'shift_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function personal_information(){
        return $this->hasOne(PersonalInformation::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function comment(){
        return $this->hasOne(Comment::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public function shift(){
        return $this->belongsTo(Shift::class);
    }
}

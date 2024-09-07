<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'admin_id' => ['required'],
            'password' => ['required','min:6'],
        ];
    }

    public function authenticate(): void
    {


        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['faculty_code' => $this->admin_id, 'password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'admin_id' => trans('auth.failed'),
            ]);
        }

        $user = Auth::user();
        $isAdmin = $user->roles()->where('role_id', 1)->exists();

//            dd($isAdmin);

        if ($isAdmin) {
            RateLimiter::clear($this->throttleKey());
        } else {

            Auth::logout(); // Log out the non-admin user

            $this->session()->invalidate(); // Invalidate the session

            $this->session()->regenerateToken(); // Regenerate CSRF token

            throw ValidationException::withMessages([
                'admin_id' => trans('auth.no_admin_access'),
            ]);

        }
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'admin_id' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}

<?php

namespace App\Livewire\Forms;

use App\Mail\Auth\TwoFactorTokenMail;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only(['email', 'password']))) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages(['form.email' => trans('auth.failed')]);
        }

        $user = Auth::user();

        if ($user->two_factor_secret) {
            $this->sendTwoFactorToken($user);
            Auth::logout();

            session()->flash('status', 'Foi enviado um código para seu e-mail. Confirme para continuar.');
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Envia o token 2FA e salva na sessão
     */
    private function sendTwoFactorToken($user): void
    {
        $token = rand(100000, 999999);
        Session::put('2fa:user:id', $user->id);
        Session::put('2fa:token', $token);
        Session::put('2fa:expires_at', now()->addMinutes(5));

        Mail::to($user->email)->send(new TwoFactorTokenMail($user, $token));
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}

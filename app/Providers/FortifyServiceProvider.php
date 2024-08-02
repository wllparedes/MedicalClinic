<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Patient;
use App\Models\User;
use Auth;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Custom authentication with username and password
        // https://laravel.com/docs/8.x/fortify#FortifyServiceProvidercustomizing-authentication
        // Change field name from email to username in file config/fortify.php
        Fortify::authenticateUsing(function (Request $request) {

            $role = $request->role ?? 'staff';

            if ($role === 'staff') {
                $user = User::where('username', $request->username)->first();
            } elseif ($role === 'patient') {
                $user = Patient::where('username', $request->username)->first();
            }

            if ($user && Hash::check($request->password, $user->password)) {
                if ($user->active) {
                    return $user;
                } else {
                    redirect()->route('index')->with('error', config('parameters.messages.not_active'));
                }
            }
        });

        // Redirect user after login based on role
        // https://laravel.com/docs/8.x/fortify#redirecting-after-authentication
        $this->app->singleton(LoginResponse::class, function () {
            return new class implements LoginResponse
            {
                public function toResponse($request)
                {
                    $type = Auth::user()->user_type;

                    switch ($type) {
                        case 'user':
                            $role = Auth::user()->role;

                            $home = match ($role) {
                                'admin' => 'admin.dashboard',
                                'doctor' => 'doctor.dashboard',
                                'receptionist' => 'receptionist.dashboard',
                                default => route('welcome'),
                            };
                            break;
                        case 'patient':
                            $home = 'patient.dashboard';
                            break;
                    }

                    return $request->wantsJson()
                        ? new JsonResponse('', 204)
                        : redirect()->route($home);
                }
            };
        });


        // Redirect user after logout
        // https://laravel.com/docs/8.x/fortify#redirecting-after-logout
        $this->app->singleton(LogoutResponse::class, function () {
            return new class implements LogoutResponse
            {
                public function toResponse($request)
                {
                    return redirect()->route('login');
                }
            };
        });
    }
}

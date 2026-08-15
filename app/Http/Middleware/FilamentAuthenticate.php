<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Database\Eloquent\Model;

class FilamentAuthenticate extends Middleware
{
    /**
     * @param  array<string>  $guards
     */
    protected function authenticate($request, array $guards): void
    {
        $guard = Filament::auth();

        // Not logged in at all — redirect to login page
        if (! $guard->check()) {
            $this->unauthenticated($request, $guards);

            return;
        }

        $this->auth->shouldUse(Filament::getAuthGuard());

        /** @var Model $user */
        $user = $guard->user();

        $panel = Filament::getCurrentOrDefaultPanel();

        // Logged in but not an admin — logout from panel guard and redirect to login
        if ($user instanceof FilamentUser && ! $user->canAccessPanel($panel)) {
            $guard->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $loginUrl = Filament::getLoginUrl();

            $request->session()->flash('danger', 'Akun ini tidak memiliki akses ke panel admin.');

            $this->unauthenticated($request, $guards);

            return;
        }
    }

    protected function redirectTo($request): ?string
    {
        return Filament::getLoginUrl();
    }
}

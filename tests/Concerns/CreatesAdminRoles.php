<?php

namespace Tests\Concerns;

use Spatie\Permission\Models\Role;

trait CreatesAdminRoles
{
    protected function createAdminRoles(): void
    {
        Role::findOrCreate('super_admin', 'web');
        Role::findOrCreate('panel_user', 'web');
    }
}

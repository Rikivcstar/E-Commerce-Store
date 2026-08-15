<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Buat role standar (super_admin, panel_user), akun admin,
     * dan migrasi role lama "Staff" menjadi panel_user.
     */
    public function run(): void
    {
        // Pastikan seluruh permission Shield tersedia untuk semua resource/widget.
        Artisan::call('shield:generate', [
            '--all' => true,
            '--option' => 'permissions',
            '--panel' => 'back',
        ]);

        Role::findOrCreate('super_admin', 'web');
        $panelUser = Role::findOrCreate('panel_user', 'web');

        // Default: panel_user menerima semua permission (pengaturan lanjutan bisa
        // disesuaikan via resource Role di panel).
        $panelUser->syncPermissions(Permission::all());

        // Akun admin utama.
        $admin = User::firstOrCreate(
            ['email' => 'admin@webstore.test'],
            [
                'name' => 'Admin WebStore',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->syncRoles(['super_admin']);

        // Migrasi role lama "Staff" (sebelumnya tidak diakui canAccessPanel)
        // menjadi panel_user agar akun staf tetap bisa mengakses panel.
        $staffRole = Role::findByName('Staff', 'web');

        if ($staffRole) {
            $staffRole->users()->get()->each(function (User $user) {
                $user->syncRoles(['panel_user']);
            });
        }
    }
}

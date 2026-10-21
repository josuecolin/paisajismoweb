<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@paisajismo.com'],
            [
                'name'     => 'Administrador',
                'email'    => 'admin@paisajismo.com',
                'password' => Hash::make('Admin1234!'),
                'is_admin' => true,
            ]
        );

        $this->command->info('✅ Usuario admin creado:');
        $this->command->info('   Email:    admin@paisajismo.com');
        $this->command->info('   Password: Admin1234!');
        $this->command->warn('   ⚠️  Cambia la contraseña después de iniciar sesión.');
    }
}

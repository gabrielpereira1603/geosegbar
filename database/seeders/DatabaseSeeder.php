<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'pereiragabrieldev@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user->forceFill([
            'two_factor_secret' => encrypt(Str::random(32)),
            'two_factor_recovery_codes' => encrypt(json_encode([])),
        ])->save();

        $this->command->info("Usuário de teste criado!");
        $this->command->warn("Email: pereiragabrieldev@gmail.com");
        $this->command->warn("Senha: password");
    }
}

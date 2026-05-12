<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
public function run(): void
{
User::create([
'name' => 'Praktikan',
'email' => 'praktikan@gmail.com',
'password' => Hash::make('password'),
'role' => 'praktikan'
]);
User::create([
'name' => 'Asisten',
'email' => 'asisten@gmail.com',
'password' => Hash::make('password'),
'role' => 'asisten'
]);
User::create([
'name' => 'Admin',
'email' => 'admin@gmail.com',
'password' => Hash::make('password'),
'role' => 'admin'
]);
User::create([
'name' => 'Dosen',
'email' => 'dosen@gmail.com',
'password' => Hash::make('password'),
'role' => 'dosen'
]);
}
}

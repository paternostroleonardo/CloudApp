<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

 DB::table('users')->delete();
 $userdefault1 = User::create([
    'name' => 'Leonardo',
    'email' => 'leonardopaternostro@etraining.com',
    'email_verified_at' => now(),
    'identification' => '1234093438',
    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
 ]);
 $userdefault2 = User::create([
     'name' => 'Oscar',
     'email' => 'oscarpalomino@etraining.com',
     'email_verified_at' => now(),
     'identification' => '97120925',
     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
  ]);
    }
}

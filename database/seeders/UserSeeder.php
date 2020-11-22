<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
use Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Pooja pant',
            'email' => 'pooja@gmail.com',
            'password' => Hash::make('12345678'),
            'role'=>'admin',
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Bimal pant',
            'email' => 'bimal@gmail.com',
            'password' => Hash::make('12345678'),
            'role'=>'officers',
        ]);
    }
}

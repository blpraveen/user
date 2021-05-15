<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call([           
        RoleTableSeeder::class,
        PermissionTableSeeder::class,
        DishTableSeeder::class,
        ]);
    	$user = User::updateOrCreate(['id' => 1],[
            'name' => 'Admin',
            'email' => 'author@mailinator.com',
            'password' => Hash::make('123456'),
            'email_verified_at'=> Carbon::now()->toDateTimeString(),
        ]);
        $user->assignRole('Admin');
    	$user = User::updateOrCreate(['id' => 2],[
            'name' => 'User One',
            'email' => 'userone@mailinator.com',
            'password' => Hash::make('123456'),
            'email_verified_at'=> Carbon::now()->toDateTimeString(),
        ]);
        $user->assignRole('Customer');      
    	$user = User::updateOrCreate(['id' => 3],[
            'name' => 'User Two',
            'email' => 'usertwo@mailinator.com',
            'password' => Hash::make('123456'),
            'email_verified_at'=> Carbon::now()->toDateTimeString(),
        ]);
        $user->assignRole('Customer'); 
    }
}

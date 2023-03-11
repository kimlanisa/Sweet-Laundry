<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\{User,notifications_setting};

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert data ke table pegawai
        $user = User::create([
        	'name' => 'Administrator',
        	'email' => 'admin@laundry.com',
        	'status' => 'Active',
          'auth' => 'Admin',
          'password' => bcrypt('123456')
        ]);

        // Set role admin
        $role = Role::create(['name' => 'Admin']);
        $user->assignRole('Admin');

    }
}

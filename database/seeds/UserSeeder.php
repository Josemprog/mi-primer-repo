<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        $adminRole = Role::create(['name'  => 'admin']);

        $admin = new User();
        $admin->name = 'JoseM';
        $admin->email = 'Josemprog@gmail.com';
        $admin->email_verified_at = now();
        $admin->password = bcrypt('erosennin620');
        $admin->main_admin = true;
        $admin->admin = true;
        $admin->remember_token = Str::random(10);
        $admin->save();
        
        $admin->assignRole($adminRole);

        factory(App\User::class, 5)->create();
    }
}

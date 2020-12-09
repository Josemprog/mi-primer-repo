<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        User::truncate();

        // Roles
        $adminRole = Role::create(['name'  => 'main-admin']);
        $supervisorRole = Role::create(['name'  => 'supervisor']);

        // Permissions
        $EditProducts = Permission::create(['name' => 'Edit Products']);
        $StoreProducts = Permission::create(['name' => 'Store Products']);
        $DestroyProducts = Permission::create(['name' => 'Destroy Products']);

        $admin = new User();
        $admin->name = 'JoseM';
        $admin->email = 'Josemprog@gmail.com';
        $admin->email_verified_at = now();
        $admin->password = bcrypt('erosennin620');
        $admin->main_admin = true;
        $admin->admin = true;
        $admin->remember_token = Str::random(10);
        $admin->save();
        
        // Assigning roles
        $admin->assignRole($adminRole);
        
        // Assigning permissions
        $adminRole->givePermissionTo($EditProducts);
        $adminRole->givePermissionTo($StoreProducts);
        $adminRole->givePermissionTo($DestroyProducts);
        $supervisorRole->givePermissionTo($EditProducts);
        
        factory(App\User::class, 100)->create();
    }
}

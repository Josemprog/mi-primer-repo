<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'JoseM';
        $user->email = 'Josemprog@gmail.com';
        $user->email_verified_at = now();
        $user->password = bcrypt('erosennin620');
        $user->main_admin = true;
        $user->admin = true;
        $user->remember_token = Str::random(10);
        $user->save();

        factory(App\User::class, 30)->create();
    }
}

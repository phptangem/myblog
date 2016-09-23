<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $username = 'admin@admin.com';
        $password = '123456';
        $data = [
            'name' => 'admin',
            'email' => $username,
            'password' =>bcrypt($password),
        ];
        User::create($data);
        $this->command->info("New Admin created. Username: $username, Password: $password");
    }
}

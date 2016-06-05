<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Model::unguard();

        // $this->call(UserTableSeeder::class);

        $this->call('UserTableSeeder');
        $this->call('ActionHistoryCodeTableSeeder');
        $this->call('MenuTableSeeder');
        $this->call('SubMenuTableSeeder');

        Model::reguard();
    }
}

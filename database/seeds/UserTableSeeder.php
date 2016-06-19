<?php

use Illuminate\Database\Seeder;
use ProductsControl\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        factory('ProductsControl\User')->create(
            [
                'name'=> 'Felipe Scampini da Silva',
                'email' => 'fscampini@gmail.com',
                'password' => Hash::make('evfdna85'),
                'is_admin' => true,
                'is_superuser' => true
            ]
        );

        factory('ProductsControl\User', 10)->create();

        // Atribuindo o menu ao usuário Felipe Scampini
        $user = User::find(1);
        $user->menus()->attach([1,2,3,4,5,6,7,8,9]);
    }
}

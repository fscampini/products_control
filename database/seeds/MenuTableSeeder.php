<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();

        factory('ProductsControl\Menu')->create(
            [
                'route_description' => 'superuser.menu.index',
                'font_awesome_description' => '<i class="fa fa-lock" aria-hidden="true"></i>',
                'name' => 'Administrador',
                'created_by' => 1,
                'last_updated_by' => 1
            ]
        );

        factory('ProductsControl\Menu')->create(
            [
                'route_description' => 'superuser.menu.index',
                'font_awesome_description' => '<i class="fa fa-magic" aria-hidden="true"></i>',
                'name' => 'Super Usuário',
                'created_by' => 1,
                'last_updated_by' => 1
            ]
        );

        factory('ProductsControl\Menu')->create(
            [
                'route_description' => 'superuser.menu.index',
                'font_awesome_description' => '<i class="fa fa-plug" aria-hidden="true"></i>',
                'name' => 'Cadastrar Menu',
                'created_by' => 1,
                'last_updated_by' => 1,
                'parent_menu_id' => 2
            ]
        );


    }
}

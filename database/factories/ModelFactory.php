<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(ProductsControl\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(ProductsControl\Menu::class, function (Faker\Generator $faker) {
    return [
        'route_description' => 'documents.upload_documents',
        'font_awesome_description' => '<i class="fa fa-share-alt" aria-hidden="true"></i>',
        'name' => $faker->name,
        'created_by' => 1,
        'last_updated_by' => 1
    ];
});

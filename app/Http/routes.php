<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::pattern('id', '[0-9]+');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'test' => 'TestController'
]);


Route::group(['middleware' => ['web','auth']], function()
{

    Route::get('/', ['uses' => 'OrderController@index']);

    Route::group(['prefix' => 'order'], function(){
        Route::get('/', ['as' => 'order.index', 'uses' => 'OrderController@index']);
        Route::get('/create', ['as' => 'order.create', 'uses' => 'OrderController@create']);
        Route::post('/store', ['as' => 'order.store', 'uses' => 'OrderController@store']);
        Route::get('{id}/edit', ['as' => 'order.edit', 'uses' => 'OrderController@edit']);
        Route::put('{id}/update', ['as' => 'order.update', 'uses' => 'OrderController@update']);
        Route::get('{id}/destroy', ['as' => 'order.destroy', 'uses' => 'OrderController@destroy']);
    });

    Route::group(['prefix'=>'admin', 'middleware' => 'admin'], function(){

        Route::group(['prefix' => 'user'], function(){
            Route::get('{id}/details', ['as' => 'admin.user.details', 'uses' => 'AccessControlController@details']);
            Route::post('attach', ['as' => 'admin.user.attach', 'uses' => 'AccessControlController@attach']);
        });

        Route::group(['prefix' => 'category'], function(){
            Route::get('/', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index']);
            Route::get('/create', ['as' => 'admin.category.create', 'uses' => 'CategoryController@create']);
            Route::post('/store', ['as' => 'admin.category.store', 'uses' => 'CategoryController@store']);
            Route::get('{id}/edit', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@edit']);
            Route::put('{id}/update', ['as' => 'admin.category.update', 'uses' => 'CategoryController@update']);
            Route::get('{id}/destroy', ['as' => 'admin.category.destroy', 'uses' => 'CategoryController@destroy']);
        });

        Route::group(['prefix' => 'product'], function(){
            Route::get('/', ['as' => 'admin.product.index', 'uses' => 'ProductController@index']);
            Route::get('/create', ['as' => 'admin.product.create', 'uses' => 'ProductController@create']);
            Route::post('/store', ['as' => 'admin.product.store', 'uses' => 'ProductController@store']);
            Route::get('{id}/edit', ['as' => 'admin.product.edit', 'uses' => 'ProductController@edit']);
            Route::put('{id}/update', ['as' => 'admin.product.update', 'uses' => 'ProductController@update']);
            Route::get('{id}/destroy', ['as' => 'admin.product.destroy', 'uses' => 'ProductController@destroy']);
        });

        Route::get('/', function () {
            return view('users.user_details');
        });
    });

    Route::group(['prefix'=>'superuser', 'middleware' => 'superuser'], function(){
        Route::group(['prefix' => 'menu'], function(){
            Route::get('/', ['as' => 'superuser.menu.index', 'uses' => 'MenuController@index']);
            Route::get('/create', ['as' => 'superuser.menu.create', 'uses' => 'MenuController@create']);
            Route::post('/store', ['as' => 'superuser.menu.store', 'uses' => 'MenuController@store']);
            Route::get('{id}/edit', ['as' => 'superuser.menu.edit', 'uses' => 'MenuController@edit']);
            Route::put('{id}/update', ['as' => 'superuser.menu.update', 'uses' => 'MenuController@update']);
            Route::get('{id}/destroy', ['as' => 'superuser.menu.destroy', 'uses' => 'MenuController@destroy']);
            Route::get('{id}/submenu', ['as' => 'superuser.menu.submenu.index', 'uses' => 'MenuController@submenuIndex']);
        });

        Route::group(['prefix' => 'role'], function(){
            Route::get('/', ['as' => 'superuser.role.index', 'uses' => 'RoleController@index']);
            Route::get('/create', ['as' => 'superuser.role.create', 'uses' => 'RoleController@create']);
            Route::post('/store', ['as' => 'superuser.role.store', 'uses' => 'RoleController@store']);
            Route::get('{id}/edit', ['as' => 'superuser.role.edit', 'uses' => 'RoleController@edit']);
            Route::put('{id}/update', ['as' => 'superuser.role.update', 'uses' => 'RoleController@update']);
            Route::get('{id}/destroy', ['as' => 'superuser.role.destroy', 'uses' => 'RoleController@destroy']);

            Route::group(['prefix' => 'permissions'], function(){
                Route::get('/{id}', ['as' => 'superuser.role.permissions', 'uses' => 'RoleController@permissions']);
                Route::get('/revoke/{id}', ['as' => 'superuser.role.permissions.revoke', 'uses' => 'RoleController@revokePermission']);
                Route::post('/add', ['as' => 'superuser.role.permissions.add', 'uses' => 'RoleController@addPemission']);
            });

        });
        Route::group(['prefix' => 'permission'], function(){
            Route::get('/', ['as' => 'superuser.permission.index', 'uses' => 'PermissionController@index']);

            Route::get('/create', ['as' => 'superuser.permission.create', 'uses' => 'PermissionController@create']);
            Route::post('/store', ['as' => 'superuser.permission.store', 'uses' => 'PermissionController@store']);
            Route::get('{id}/edit', ['as' => 'superuser.permission.edit', 'uses' => 'PermissionController@edit']);
            Route::put('{id}/update', ['as' => 'superuser.permission.update', 'uses' => 'PermissionController@update']);
            Route::get('{id}/destroy', ['as' => 'superuser.permission.destroy', 'uses' => 'PermissionController@destroy']);
        });

    });
});




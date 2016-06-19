<?php

namespace ProductsControl\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use ProductsControl\Menu;
use ProductsControl\User;


class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    /*public function update(User $user, Menu $menu)
    {
        return $user->is_admin;
    }*/

}

<?php

namespace ProductsControl\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use ProductsControl\Menu;
use ProductsControl\User;

class AccessControlController extends Controller
{
   private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function details($id, Menu $menu){
        $user_menus = $this->userModel->find($id)->menus->lists('id');
        $menus = $menu->all();
        $user = $this->userModel->find($id);
        return view('users.edit', compact('user_menus', 'menus', 'user'));
    }


    public function teste_rota(Route $route){
        dd($route->getName());
    }

    public function attach(Request $request){
        if ($request->ajax()) {
            try{

                if($request->menu_ids == ""){
                    $array_menus = [];
                } else {
                    $array_menus = $request->menu_ids;
                }
                $this->userModel->find($request->user_id)->menus()->sync($array_menus);

                $content = ['status' => 'true'];
            } catch (\Exception $e) {
                $content = [
                    'status' => 'false',
                    'error_message' => $e->getMessage()
                ];
            }

        } else {
            $content = ['status' => 'false',
                        'error_message' => 'Requisição ao servidor inválida!'];
        }

        return $content;
    }
}

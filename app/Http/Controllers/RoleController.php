<?php

namespace ProductsControl\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use ProductsControl\Http\Requests;
use ProductsControl\Role;

class RoleController extends Controller
{
    private $roleModel;

    public function __construct(Role $roleModel)
    {
        $this->roleModel = $roleModel;
    }

    public function index(){
        $roles = $this->roleModel->paginate(6);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return Redirect::to('superuser/role/create')->withErrors($validator);
        } else {

            try {

                $this->roleModel->create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'created_by' => Auth::user()->id,
                    'last_updated_by' => Auth::user()->id
                ]);

            } catch (\Exception $e) {
                return Redirect::to('superuser/role/create')->withErrors($e->getMessage());
            }
        }

        return Redirect::to('superuser/role');
    }

    public function edit($id)
    {
        $role = $this->roleModel->find($id);

        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        /* Exemplo de autorização
         * $menu = Menu::find(1);
         * $this->authorize('update', $menu);
         */

        $rules = array(
            'name' => 'required',
            'description' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return back()->withErrors($validator);
        } else {

            try {

                $this->roleModel->find($id)->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'last_updated_by' => Auth::user()->id
                ]);

            } catch (\Exception $e) {
                return back()->withErrors($e->getMessage());
            }
        }

        return Redirect::to('superuser/role');
    }

    public function destroy($id)
    {
        try {

            $roleModel = $this->roleModel->find($id);
            $roleModel->delete();

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('superuser.role.index');
    }

    public function permissions($id){
        return $id;
    }
}

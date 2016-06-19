<?php

namespace ProductsControl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use ProductsControl\Category;
use ProductsControl\Http\Requests;

class CategoryController extends Controller
{
    private $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function index(){
        $categories = $this->categoryModel->paginate(6);
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return Redirect::to('admin/category/create')->withErrors($validator);
        } else {

            try {

                $this->categoryModel->create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'created_by' => Auth::user()->id,
                    'last_updated_by' => Auth::user()->id
                ]);

            } catch (\Exception $e) {
                return Redirect::to('admin/category/create')->withErrors($e->getMessage());
            }
        }

        return Redirect::to('admin/category');
    }

    public function edit($id)
    {
        $category = $this->categoryModel->find($id);

        return view('category.edit', compact('category'));
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

                $this->categoryModel->find($id)->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'last_updated_by' => Auth::user()->id
                ]);

            } catch (\Exception $e) {
                return back()->withErrors($e->getMessage());
            }
        }

        return Redirect::to('admin/category');
    }

    public function destroy($id)
    {
        try {

            $category = $this->categoryModel->find($id);
            $category->delete();

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('admin.category.index');
    }

    public function permissions($id){
        return $id;
    }
}

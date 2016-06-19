<?php

namespace ProductsControl\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use ProductsControl\Category;
use ProductsControl\Http\Requests;
use ProductsControl\Product;

class ProductController extends Controller
{
    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel= $productModel;
    }

    public function index(){
        $products = $this->productModel->paginate(6);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::lists('name', 'id');;
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return Redirect::to('admin/product/create')->withErrors($validator);
        } else {

            try {

                $this->productModel->create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'category_id' => $request->category_id,
                    'price' => $request->price,
                    'created_by' => Auth::user()->id,
                    'last_updated_by' => Auth::user()->id
                ]);

            } catch (\Exception $e) {
                return Redirect::to('admin/product/create')->withErrors($e->getMessage());
            }
        }

        return Redirect::to('admin/product');
    }

    public function edit($id)
    {
        $categories = Category::lists('name', 'id');
        $product = $this->productModel->find($id);

        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        /* Exemplo de autorização
         * $menu = Menu::find(1);
         * $this->authorize('update', $menu);
         */

        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return back()->withErrors($validator);
        } else {

            try {

                $this->productModel->find($id)->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'category_id' => $request->category_id,
                    'price' => $request->price,
                    'last_updated_by' => Auth::user()->id
                ]);

            } catch (\Exception $e) {
                return back()->withErrors(['errors',$e->getMessage()]);
            }
        }

        return Redirect::to('admin/product');
    }

    public function destroy($id)
    {
        try {

            $product = $this->productModel->find($id);
            $product->delete();

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('admin.product.index');
    }

    public function permissions($id){
        return $id;
    }
}

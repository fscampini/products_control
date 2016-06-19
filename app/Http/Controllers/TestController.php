<?php namespace ProductsControl\Http\Controllers;

use ProductsControl\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{

    public function index()
    {
        $data['tasks'] = [
            [
                'name' => 'Design New Dashboard',
                'progress' => '87',
                'color' => 'danger'
            ],
            [
                'name' => 'Create Home Page',
                'progress' => '76',
                'color' => 'warning'
            ],
            [
                'name' => 'Some Other Task',
                'progress' => '32',
                'color' => 'success'
            ],
            [
                'name' => 'Start Building Website',
                'progress' => '56',
                'color' => 'info'
            ],
            [
                'name' => 'Develop an Awesome Algorithm',
                'progress' => '10',
                'color' => 'success'
            ]
        ];
        return view('test')->with($data);
    }

    public function post_upload(Request $request){

        $rules = array(
            'file' => 'required|max:10000',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json('error', 400);
        } else {
            $file = $request->file('file')->getClientOriginalName();

            Storage::disk('public_local')->put($file, $file);
            return response()->json('Arquivo carregado com sucesso!', 400);
        }
    }
}

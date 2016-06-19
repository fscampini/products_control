<?php

namespace ProductsControl\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use ProductsControl\Http\Requests;
use ProductsControl\Order;

class OrderController extends Controller
{
    private $orderModel;

    public function __construct(Order $orderModel)
    {
        $this->orderModel= $orderModel;
    }

    public function index(){
        $orders = $this->orderModel->paginate(6);
        return view('order.index', compact('orders'));
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'client_name' => 'required',
            'client_phone' => 'required',
            'client_address' => 'required',
            'client_email' => 'required',
            'shipment_date' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return Redirect::to('order/create')->withErrors($validator);
        } else {

            try {

                $this->orderModel->create([
                    'client_name' => $request->client_name,
                    'client_phone' => $request->client_phone,
                    'client_address' => $request->client_address,
                    'client_email' => $request->client_email,
                    'shipment_date' => $request->shipment_date,
                    'created_by' => Auth::user()->id,
                    'last_updated_by' => Auth::user()->id,
                    'status' => 0
                ]);

            } catch (\Exception $e) {
                return Redirect::to('order/create')->withErrors($e->getMessage());
            }
        }

        return Redirect::to('order');
    }

    public function edit($id)
    {
        $order = $this->orderModel->find($id);

        return view('order.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        /* Exemplo de autorização
         * $menu = Menu::find(1);
         * $this->authorize('update', $menu);
         */

        $rules = array(
            'client_name' => 'required',
            'client_phone' => 'required',
            'client_address' => 'required',
            'client_email' => 'required',
            'shipment_date' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return back()->withErrors($validator);
        } else {

            try {

                $this->orderModel->find($id)->update([
                    'client_name' => $request->client_name,
                    'client_phone' => $request->client_phone,
                    'client_address' => $request->client_address,
                    'client_email' => $request->client_email,
                    'shipment_date' => $request->shipment_date,
                    'last_updated_by' => Auth::user()->id
                ]);

            } catch (\Exception $e) {
                return back()->withErrors(['errors',$e->getMessage()]);
            }
        }

        return Redirect::to('order');
    }

    public function destroy($id)
    {
        try {

            $order = $this->orderModel->find($id);
            $order->delete();

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('order.index');
    }
}

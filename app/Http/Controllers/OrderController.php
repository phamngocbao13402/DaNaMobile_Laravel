<?php

namespace App\Http\Controllers;
use  App\Models\Order;
use  App\Models\OrderDetails;
use  App\Models\Slider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session as FacadesSession;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('orderdetail','payment')
        ->orderBy('orders.id','desc')
        ->get();
        
        return view('admin.order.list',compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->status = $request -> status;
        $order->save();

        return redirect('/admin/order/list');

        // $slider = Slider::find($id);
        // $slider->update($request->only('slider_img'));
        // return redirect()->route('slider.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $detail = OrderDetails::where('order_id','=', $id)->get();
        return view('admin.order.details', compact('order','detail'));
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.order.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order ->id = $request->id;
        $order ->status = $request->status;

        $order->save();
        // dd($order);
        return redirect('admin/order/list')->with('status','Bạn đã cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // filter status order
    public function filter_status_order (Request $request)
    {
        $key_word = $request['filter_status_order'];
        if ($key_word == 0) {
            $orders = Order::with('orderdetail')->where('orders.status','=', '0')->get();
        } elseif ($key_word == 1) {
            $orders = Order::with('orderdetail')->where('orders.status','=', '1')->get();
        } elseif ($key_word == 2) {
            $orders = Order::with('orderdetail')->where('orders.status','=', '2')->get();
        } elseif ($key_word == 3) {
            $orders = Order::with('orderdetail')->where('orders.status','=', '3')->get();
        }else {
            $orders = Order::with('orderdetail')
        ->orderBy('orders.id','desc')
        ->get();
        }
        if (count($orders) > 0){
            return view('admin.order.list',compact('orders'));
        }else {
            $request->session()->now('message', 'Không có đơn hàng nào ở trạng thái này !');
            return view('admin.order.list',compact('orders'));
        }   

    }
}
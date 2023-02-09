<?php

namespace App\Http\Controllers;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User_addresses;
use Illuminate\Support\Facades\Auth;
use App\Models\Combinations;
use App\Models\User;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.  
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        $detail = OrderDetails::join('products_combinations','products_combinations.id', '=', 'order_details.product_id')
        ->where('order_id','=', $id)->get();
        $order = Order::where('orders.id','=', $id)->first();  
        $address = User_addresses::where('user_id', Auth::id())->first();
        // dd($order);
        $products = Product::find($id);
        return view('admin.order.details',compact('detail','order','products','address'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
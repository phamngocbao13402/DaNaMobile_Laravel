<?php

namespace App\Http\Controllers;

use App\Models\Stocks;
use App\Models\Product;
use App\Models\Combinations;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $allstocks = Stocks::all();
        $products_stocks = Product::with(['combinations'])->get();

        return view('admin.stocks.list')->with(compact('products_stocks'));
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
     * @param  \App\Models\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $combi = Combinations::with(['product'])->where('products_combinations.product_id',$id)->get();
        return view('admin.stocks.stockdetail')->with(compact('combi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function edit(Stocks $stocks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stocks $stocks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stocks $stocks)
    {
        //
    }

    public function search(){
        $keyword = $_GET['key_search'];
        $products_stocks = Product::with(['combinations', 'stock'])->where('product_name','LIKE', '%' . $keyword . '%')->get();
        return view('admin.stocks.list', compact('products_stocks'));
    }

    public function name(){
        $key = $_GET['name'];      
        if($key == 0){
            $products_stocks = Product::with(['combinations', 'stock'])->get();
            return view('admin.stocks.list', compact('products_stocks'));
        }else if( $key == 1){
            $products_stocks = Product::with(['combinations', 'stock'])->orderBy('product_name', 'DESC')->get();
            return view('admin.stocks.list', compact('products_stocks'));
        }else{
            $products_stocks = Product::with(['combinations', 'stock'])->orderBy('product_name', 'ASC')->get();
            return view('admin.stocks.list', compact('products_stocks'));
        }
    }

}

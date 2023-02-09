<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Preview;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Http\Middleware\checklogin;
use Illuminate\Support\Facades\DB;

class PreviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $previews = Preview::with('product')
            ->select(DB::raw('product_id, max(created_at) as maxdate, min(created_at) as mindate, avg(status) as avgrate'), DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->get();
        return view('admin.preview.list', compact('previews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $detail = Preview::with(['product', 'user'])->where('product_reviews.product_id', $id)->get();
        return view('admin.preview.detail')->with(compact('detail'));
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
        $preview = Preview::find($id);
        $preview->delete();
        return redirect('admin/preview/list')->with('status', 'Bạn đã Xóa thành công');
    }

    public function filterPreviewByDate (Request $request)
    {
        $key_word = $request['filter_preview_date'];
        if($key_word == 1){
            $previews = Preview::with('product')
            ->select(DB::raw('product_id, max(created_at) as maxdate, min(created_at) as mindate, avg(status) as avgrate'), DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->orderBy('maxdate', 'DESC')
            ->get();
        }else{
            $previews = Preview::with('product')
            ->select(DB::raw('product_id, max(created_at) as maxdate, min(created_at) as mindate, avg(status) as avgrate'), DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->orderBy('maxdate', 'ASC')
            ->get();
        }
        return view('admin.preview.list', compact('previews'));

    }
}
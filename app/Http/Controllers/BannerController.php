<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $banner;

    public function __construct()
    {
        $this->banner = new Banner();
    }

    public function index()
    {
        $result = $this->banner->all();
        return view('admin.banners.list', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        if ($request->has('file_img')) {
            $file = $request->file_img;
            $file_name = $file->getClientoriginalName();
            $file->move(public_path('images/banner'), $file_name);
        }
        $request->merge(['banner_img' => $file_name]);
        if (Banner::create($request->all())) {
            return redirect()->route('banner.list')->with('success', 'Thêm thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = $this->banner->find($id);
        return view('admin.banners.edit', compact('banner'));
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
        if ($request->has('file_img')) {
            $file = $request->file_img;
            $file_name = $file->getClientoriginalName();
            $file->move(public_path('images/banner'), $file_name);
        }
        $request->merge(['banner_img' => $file_name]);
        $banner = Banner::find($id);
        $banner->update($request->all());
        return redirect()->route('banner.list')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->route('banner.list');
    }
}

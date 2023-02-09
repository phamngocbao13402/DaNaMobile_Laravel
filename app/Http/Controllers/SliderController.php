<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $slider;

    public function __construct()
    {
        $this->slider = new Slider();$this->middleware('auth');
    }
    public function index()
    {
        $result = $this->slider::all();
        return view('admin.sliders.list', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        if ($request->has('file_img')) {
            $file = $request->file_img;
            $file_name = $file->getClientoriginalName();
            // dd($file_name);
            $file->move(public_path('images/slider'), $file_name);
        }

        $request->merge(['slider_img' => $file_name]);
        // dd($request->all());
        if (Slider::create($request->all())) {
            return redirect()->route('slider.list')->with('success', 'Thêm thành công');
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
        $slider = $this->slider->find($id);
        return view('admin.sliders.edit', compact('slider'));
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
            $file->move(public_path('images/slider'), $file_name);
        }
        $request->merge(['slider_img' => $file_name]);
        $slider = Slider::find($id);
        $slider->update($request->only('slider_img'));
        return redirect()->route('slider.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return redirect()->route('slider.list');
    }
}

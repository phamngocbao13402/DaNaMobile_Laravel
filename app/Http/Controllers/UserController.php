<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Slider;
use App\Models\User;
use App\Models\User_addresses;
use App\Models\VoucherUser;
use App\Models\Voucher;
use Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alluser = User::all();
        return view('admin.user.list')->with(compact('alluser'));
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
        $categories = Category::all();
        $slider = Slider::first()->orderBy('slider.created_at','DESC')->paginate(1);
        $banner = Banner::first()->orderBy('banner.created_at','DESC')->paginate(1);
        $user = User::find($id);
        return view('client.user.show')->with(compact('categories','slider','banner','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit')->with(compact('user'));
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
        $user = User::find($id);
        $user ->id = $request->id;
        $user ->role = $request->role;
        $user ->status = $request->status;
        // $user ->email = $request->email;

        $user->save();
        // dd($order);
        return  $this->index()->with('status','B???n ???? c???p nh???t th??nh c??ng');
        
    }


    // client
    public function useredit($id)
    {
        $categories = Category::all();
        $slider = Slider::first()->orderBy('slider.created_at','DESC')->paginate(1);
        $banner = Banner::first()->orderBy('banner.created_at','DESC')->paginate(1);
        $user = User::find($id);
        return view('client.user.edit')->with(compact('categories','slider','banner','user'));
    }

    public function userupdate(Request $request, $id)
    {
        $user = User::find($id);
        $user ->id = $request->id;
        $user ->name = $request->name;
        $user ->email = $request->email;

        $user->save();
        // dd($order);
        return  $this->show($id)->with('status','B???n ???? c???p nh???t th??nh c??ng');
        
    }

    // ?????i m???t kh???u
    public function passedit($id)
    {
        $categories = Category::all();
        $slider = Slider::first()->orderBy('slider.created_at','DESC')->paginate(1);
        $banner = Banner::first()->orderBy('banner.created_at','DESC')->paginate(1);
        $user = User::find($id);
        return view('client.user.editpass')->with(compact('categories','slider','banner','user'));
    }

    public function passupdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => [
                'required',
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m',
                'confirmed',
            ],
            'password_confirmation' => 'required'
        ], [
            'oldpassword.required' => 'Kh??ng ???????c ????? tr???ng *',
            'password.required' => 'Kh??ng ???????c ????? tr???ng *',
            'password_confirmation.required' => 'Kh??ng ???????c ????? tr???ng *',
            // 'password_confirmation.confirmed' => 'M???t kh???u kh??ng tr??ng kh???p *',
            'password.regex' => 'H??y t???o m???t m???t kh???u m???nh v???i ??t nh???t 8 ?????n 16 k?? t???, m???t ch??? hoa v?? ch??? th?????ng, m???t s??? v?? m???t k?? t??? ?????c bi???t *',
            'password.confirmed' => 'M???t kh???u kh??ng tr??ng kh???p *'
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save($validateData);
            // Auth::logout();
            return $this->show($id)->with('status','B???n ???? c???p nh???t th??nh c??ng');
        }else{
            return redirect()->back()->with('info', 'Thay ?????i m???t kh???u kh??ng th??nh c??ng!');
        }
        
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

    public function voucher()
    {
        $categories = Category::all();
        $slider = Slider::first()->orderBy('slider.created_at','DESC')->paginate(1);
        $banner = Banner::first()->orderBy('banner.created_at','DESC')->paginate(1);
        $user = User::find(Auth::user()->id);
        $this->checkVoucher(Auth::user()->id);
        $list_vu = VoucherUser::with('vu_voucher','vu_user')->where('user_id',Auth::user()->id)->get();
        return view('client.user.voucher')->with(compact('categories','slider','banner','user', 'list_vu'));
    }

    public function checkVoucher($id){
        $list = Voucher::all();
        foreach ($list as $key ) {
            if($key->numberof < 1){
                Voucher::find($key->id)->delete();
                VoucherUser::where('voucher_id',$key->id)->delete();
            }
            if($key->time < date('Y-m-d', time())){
                Voucher::find($key->id)->delete();
                VoucherUser::where('voucher_id',$key->id)->delete();
            }
        }
    }
}

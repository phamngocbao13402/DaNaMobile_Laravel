<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Voucher;
use App\Models\VoucherUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $voucher;
    public function __construct()
    {
        $this->voucher = new Voucher();
    }
    public function index()
    {
        $result = $this->voucher->orderBy('id', 'DESC')->get();
        return view('admin.voucher.list', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voucher = new Product();
        $result = $voucher::all();
        return view('admin.voucher.create', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherRequest $request)
    {

        $vou = new Voucher();
        $vouchers = Voucher::all();
        // $vou->voucher_id = $request['vocher_id'];
        $vou->code = $request['voucher_code'];
        $vou->type = $request['voucher_type'];
        $vou->value = $request['voucher_value'];
        $vou->numberof = $request['voucher_numberof'];
        $vou->time = $request['voucher_time'];
        $vou->product_id = $request['voucher_product_id'];
        $vou->status = $request['voucher_status'];
        $vou->save();
        return redirect()->route('voucher.list')->with('success', 'Thêm thành công');
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
        $voucher = $this->voucher->find($id);
        $result = Product::all();
        return view('admin.voucher.edit', compact('voucher', 'result'));
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
        // $vou = Voucher::find($id);
        $vou = Voucher::with('voucher_product')->find($id);
        // $vou->voucher_id = $request['voucher_id'];
        $vou->code = $request['voucher_code'];
        $vou->type = $request['voucher_type'];
        $vou->value = $request['voucher_value'];
        $vou->numberof = $request['voucher_numberof'];
        $vou->product_id = $request['voucher_product_id'];
        $vou->status = $request['voucher_status'];
        $vou->save();

        return redirect()->route('voucher.list')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voucher = Voucher::find($id);
        $voucher->delete();
        return redirect()->route('voucher.list');
    }

    public function checkVoucher($id)
    {
        $list = Voucher::all();
        foreach ($list as $key) {
            if ($key->numberof < 1) {
                Voucher::find($key->id)->delete();
                VoucherUser::where('voucher_id', $key->id)->delete();
            }
            if ($key->time < date('Y-m-d', time())) {
                Voucher::find($key->id)->delete();
                VoucherUser::where('voucher_id', $key->id)->delete();
            }
        }
    }

    public function list()
    {
        $result = Voucher::with('voucher_vu')->get();
        $user = "";
        if (Auth::check()) {
            $user = User::with('user_voucher')->where('users.id', Auth::user()->id)->first();
            foreach ($result as $vou) {
                foreach ($user->user_voucher as $user_vou) {
                    if ($vou->id === $user_vou->voucher_id) {
                        $vou['isGet'] = true;
                    }
                }
            }
        }

        return view('client.voucher.list', compact('result'));
    }

    public function addVoucher(Request $request)
    {
        $vu = new VoucherUser();
        $voucher = Voucher::where("id", $request['voucher_id'])->first();
        $voucher->numberof -= 1;
        $voucher->save();
        $vu->voucher_id = $request['voucher_id'];
        $vu->user_id = $request['user_id'];
        $vu->numberof = $request['numberof'];
        $vu->save();
        return redirect()->back();
    }
}
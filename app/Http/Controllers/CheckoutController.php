<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Voucher;
use App\Models\VoucherUser;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Combinations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $payments = Payment::where('payment_status', '1')->get();
        $productList = session('cart');
        $user = User::with('user_addresses')->where('users.id', $userId)->first();
        $this->checkVoucher(Auth::id());
        $list_vu = VoucherUser::with('vu_voucher','vu_user')->where('user_id',Auth::id())->get();
        return view('client.shop.checkout', compact('user', 'productList','payments','list_vu'));
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function useCheckout(Request $request)
    {
        $voucher_id = $request->voucher_id;
        $voucher = Voucher::find($voucher_id);
        $vc = session()->get('vc', []);
        // if($voucher->type ="Giảm theo tiền"){
        //     $vc['value'] = $voucher->value;
        // }else{
        //     $vc['value'] = $voucher->value*0.01;
        // }
        $vc['value'] = $voucher->value;
        $vc['id'] = $voucher->id;
        $vc['type'] = $voucher->type;
        session()->put('vc', $vc);
        // dd(session('vc')['value']);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $bill = new Order();
            $bill->user_id = $request->user_id;

            $bill->fullname = $request->fullname;
            $bill->address = $request->address;
            $bill->email = $request->email;
            $bill->phone = $request->phone;
            $bill->status = 0;
            $bill->payment_id = $request->payment_id;
            $bill->total_amount = $request->total_amount;
            $bill->voucher = $request->voucher;
            if($request->note){
                $bill->note = $request->note;
            }else{
                $bill->note = '';
            }
            $bill->save();
            foreach(session('cart') as $cart){
            
                $billDetails = new OrderDetails();
                $billDetails->order_id = $bill->id;
                $billDetails->product_id = $cart['id_combi'];
                $billDetails->quantity = $cart['quantity'];
                $billDetails->total_amount = $cart['quantity']*$cart['price'];
                $billDetails->save();
                $product = Combinations::find($billDetails->product_id);
                $product->avilableStock = $product->avilableStock - $billDetails->quantity;
                $product->save();
            } 


            if(isset($_POST['done'])){   
                $cart = [];
                session()->put('cart', $cart);  
                return redirect()->route('bill.list');
            }else if(isset($_POST['redirect'])){
                $this->vnpay_payment_test($bill->id, $bill->total_amount);
            }else if(isset($_POST['payUrl'])){
                $this->momo_payment_test($bill->id, $bill->total_amount);
            }


    }

    public function vnpay_payment_test($id, $total){     
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/checkout";
        $vnp_TmnCode = "K4ZDW395";//Mã website tại VNPAY 
        $vnp_HashSecret = "VELRGLZUEQKIMVHCRTJXWIIZAAMIRPKO"; //Chuỗi bí mật

        $vnp_TxnRef = $id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'ok';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $expire;
        //Billing
       
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $vnp_ExpireDate
            
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        // vui lòng tham khảo thêm tại code demo
    }


    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment_test($id, $total){

        // include "../common/helper.php";

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $total;
        $orderId= $id + 1000000;
        $redirectUrl = "http://127.0.0.1:8000/checkout";
        $ipnUrl = "http://127.0.0.1:8000/checkout";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        if($jsonResult['message'] !== "Giao dịch thành công."){
            echo '<script>alert("'.$jsonResult['message'].'");
            window.location="http://127.0.0.1:8000/checkout"
            </script>';
        }
        else{
            $link = $jsonResult['payUrl'];
            header('Location: ' . $link);
            die();
        }
       
    }
}

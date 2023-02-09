<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Chart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Combinations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StatisticalController extends Controller
{
    public function index()
    {
        $category = Category::count();
        $role = User::count();
        $product = Product::count();
        $order = Order::count();

        $payment = $this->transaction();
        // $probyCate = DB::table('products')
        // ->join('categories', 'products.category_id', '=', 'categories.id')
        // ->select('categories.*', 'products.*', DB::raw('count(*) as totalCate'))
        // ->where('category_id', '<>', '0')
        // ->groupBy('category_id')
        // ->pluck('totalCate', 'category_id')
        // ->all();

        return view('admin.index', compact(['category', 'role', 'product', 'order', 'payment']));
    }
    public function transaction(){
        return Payment::select('*', DB::raw('SUM(orders.total_amount) as totalPrice'))
        ->join('orders', 'orders.payment_id','payments.id')
        ->join('order_details', 'order_details.order_id', '=', 'orders.id')
        ->where('orders.status', '=', 2)
        ->groupBy('payments.id')
        ->get();
    }
    public function getAllStatisticals() {
         return view('admin.statistical.index');

    }

    function getStatistical(Request $request) {
        $startDay = $request->startDay;
        $endDay =  $request->endDay;
        $orderBy = $request->orderStat;
        $limit = $request->amountStat;
        $startDayTime = new DateTime($startDay);
        $endDayTime = new DateTime($endDay);
        $optionStat = $request->optionStat;

        if ($optionStat == 1) {
            $productStatistical = $this->sellingProducts($startDayTime, $endDayTime, $orderBy, $limit);
        }else if ($optionStat == 2){
            $productStatistical = $this->topRevenue($startDayTime, $endDayTime, $orderBy, $limit);
        }else {
            // Danh sách sản phẩm chưa có lượt mua
            $listIdproductsSold = $this->listSoldProducts();
            $productStatistical = Combinations::select('products.product_name', 'categories.category_name', 'products_combinations.*')
            ->join('products', 'products_combinations.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->whereNotIn('products_combinations.id', $listIdproductsSold)
            ->take($limit)
            ->get();
        }
        
        return response()->json([
            'status' => 200,
            'productStatistical' => $productStatistical
        ]);
        
    }

    public function sellingProducts($dayStart,$dayEnd, $orderBy, $limit) {
        return Combinations::select('products.product_name', 'categories.category_name', 'products_combinations.*', 'order_details.created_at' ,DB::raw('SUM(order_details.quantity) as totalSold'))
        ->join('order_details', 'order_details.product_id', '=', 'products_combinations.id')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'products_combinations.product_id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('orders.status', '=', 2)
        ->whereBetween('order_details.created_at', [$dayStart, $dayEnd])
        ->groupBy('products_combinations.id')
        ->having('totalSold', '>', 0)
        ->orderBy('totalSold', $orderBy)
        ->take($limit)
        ->get();
    }

    public function listSoldProducts () {
        $products = $this->sellingProductsF();
        $productsId = [];
        foreach ($products as $product) {
            array_push($productsId, $product->productcombi_id);
        }

        return $productsId;
    }

    
    public function sellingProductsF() {
        return Combinations::select('products.*', 'categories.category_name', 'products_combinations.combination_string','products_combinations.id as productcombi_id' ,DB::raw('SUM(order_details.quantity) as totalSold'))
        ->join('order_details', 'order_details.product_id', '=', 'products_combinations.id')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'products_combinations.product_id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('orders.status', '=', 2)
        ->groupBy('products_combinations.id')
        ->having('totalSold', '>', 0)
        ->orderBy('totalSold', 'DESC')
        ->get();
    }

    public function topRevenue($dayStart, $dayEnd, $orderBy, $limit) {
        return Combinations::select('products.product_name', 'categories.category_name', 'products_combinations.*' ,DB::raw('SUM(order_details.quantity) as totalSold'), DB::raw('SUM(order_details.total_amount) as totalRevenue'))
        ->join('order_details', 'order_details.product_id', '=', 'products_combinations.id')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'products_combinations.product_id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('orders.status', '=', 2)
        ->whereBetween('order_details.created_at', [$dayStart, $dayEnd])
        ->groupBy('products_combinations.id')
        ->having('totalSold', '>', 0)
        ->orderBy('totalRevenue', $orderBy)
        ->take($limit)
        ->get();
    }

   

}

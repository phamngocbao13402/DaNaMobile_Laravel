<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Product;
use App\Models\User;
use App\Models\Combinations;
use App\Models\OrderDetails;
use App\Models\Preview;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $html = '';

    public function index()
    {
        $categories = Category::all();
        $categorySelect = $this->res(0);
        $categoryhot = Category::orderBy('categories.created_at','DESC')->paginate(4);
        $categorylist = Category::where('parent_id', '!=', '0')->orderBy('categories.created_at','DESC')->get();

        foreach ($categories as $category) {
            $parent_id = $category->parent_id;
            $partenCateName = $this->getCategoryName($parent_id);
            $category['parent_cate'] = $partenCateName;
        }
        $slider = Slider::first()->orderBy('slider.created_at','DESC')->paginate(1);
        $banner = Banner::where('id', '9')->first();
        $bannerlist = Banner::where('id', '<>', '9')->get();

        // sản phẩm sale 
        $productsalemax = Combinations::with(['product'])
        ->orderBy('products_combinations.sale','desc')
        ->first();
        $proName = Product::where('id',$productsalemax->product_id)->first();
        $productsalemax['product_name'] = $proName->product_name;
        $productsalemax['id'] = $proName->id;

        // all sản phẩm
        $productsld = Product::with('combinations','category')->orderBy('products.created_at', 'desc')
            ->where('product_status', '1')
            ->take(8)
            ->get();

        $priceArr = [];
        $minPrice = 0;
        $maxPrice = 0;
        foreach ($productsld as $product) {
          foreach ($product->combinations as $productCombi) {
            array_push($priceArr, $productCombi->price);
          
            }
            $minPrice = min($priceArr);
            $maxPrice = max($priceArr);

            $priceArr = [];

            $product['minprice'] = $minPrice;
            $product['maxprice'] = $maxPrice;

        }

        // sản phẩm theo lượt xem
        $view_product = Product::with('combinations','category')->orderBy('products.product_view', 'DESC')
        ->where('product_status', '1')
        ->limit(8)
        ->get();//hiển thị theo lượt xem
        $priceArr = [];
        $minPrice = 0;
        $maxPrice = 0;
        foreach ($view_product as $product) {
          foreach ($product->combinations as $productCombi) {
            array_push($priceArr, $productCombi->price);
          
            }
            $minPrice = min($priceArr);
            $maxPrice = max($priceArr);

            $priceArr = [];

            $product['minprice'] = $minPrice;
            $product['maxprice'] = $maxPrice;

        }

        // sản phẩm theo Đánh giá
        $prevew_product = Preview::with('product')
        ->select(DB::raw('product_id, max(created_at) as maxdate, min(created_at) as mindate, avg(status) as avgrate'), DB::raw('count(*) as total'))
        ->groupBy('product_id')
        ->latest('avgrate')
        ->limit(8)
        ->get();
        
        foreach ($prevew_product as $prv) {
            $cateName = Category::find($prv->product->category_id);
            $prv['category_name'] =  $cateName->category_name;
        }

        // sản phẩm theo danh mục

        $product_cate = Category::with('products')
        // ->take(8)
        ->get();

        // top 20 sản phẩm
        $top20 = DB::table('products_combinations')
        ->select('products.*', 'categories.category_name', 'products_combinations.combination_string','products_combinations.id as productcombi_id' ,DB::raw('SUM(order_details.quantity) as sumnn'))
        ->join('order_details', 'order_details.product_id', '=', 'products_combinations.id')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'products_combinations.product_id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('orders.status', '=', 2)
        ->groupBy('products_combinations.product_id')
        ->having('sumnn', '>', 0)
        ->orderBy('sumnn', 'DESC')
        ->take(8)
        ->get();

        // random
        $random = Product::with('combinations','category')->orderBy(DB::raw('RAND()'))
        ->where('product_status', '1')
        ->limit(3)
        ->get();//random ngẫu nhiên 5 bài
        $priceArr = [];
        $minPrice = 0;
        $maxPrice = 0;
        foreach ($random as $product) {
          foreach ($product->combinations as $productCombi) {
            array_push($priceArr, $productCombi->price);
          
            }
            $minPrice = min($priceArr);
            $maxPrice = max($priceArr);

            $priceArr = [];

            $product['minprice'] = $minPrice;
            $product['maxprice'] = $maxPrice;

        }
        
        // sản phẩm sale
        $product_sale = Product::with('combinations','category')
        ->where('product_status', '1')
        ->limit(3)
        ->get();
        foreach ($product_sale as $product) {
          foreach ($product->combinations as $productCombi) {
            array_push($priceArr, $productCombi->price);
            if ($productCombi->sale > 0)  $prsale = $productCombi->sale;
            }
            $minPrice = min($priceArr);
            $maxPrice = max($priceArr);
            $priceArr = [];

            $productsale = $prsale;
            $prsale = [];

            $product['minprice'] = $minPrice;
            $product['maxprice'] = $maxPrice;
            $product['sale'] = $productsale;

        }

        // Top 3 đánh giá
        $top3preview = Preview::with('product')
        ->select(DB::raw('product_id, max(created_at) as maxdate, min(created_at) as mindate, avg(status) as avgrate'), DB::raw('count(*) as total'))
        ->groupBy('product_id')
        ->latest('avgrate')
        ->limit(3)
        ->get();
        
        foreach ($prevew_product as $prv) {
            $cateName = Category::find($prv->product->category_id);
            $prv['category_name'] =  $cateName->category_name;
        }

        return view('client.index')->with(compact('productsalemax','categories', 'categoryhot', 'categorylist', 'view_product', 'prevew_product', 'product_cate', 'slider', 'banner', 'bannerlist', 'productsld', 'top20', 'random', 'product_sale', 'categorySelect','top3preview'));

    }

    public function getCategoryName($id) {
        if($id != 0) {
            $category = Category::find($id);
            return $category->category_name;
        }
        
    }
    public function res($id, $text = '')
    {
        $data = Category::all();
        foreach ($data as $value) {          
            if ($value['parent_id'] == $id) {    
                $this->html .= '<li class="nav-item hs-has-mega-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut" data-position="left">
                <a id="basicMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">'.$value['category_name'] . '</a>';
                $this->res_sub($value['id'], $value['id']);
                $this->html .= '</li>';
            }else{
                $this->html .= '</li>';
            }
        }
        return $this->html;
    }

    public function res_sub($id, $id_parent)
    {
        $count = 0;
        $data_sub = Category::all();
        $category = Category::find($id_parent);
        foreach ($data_sub as $value_sub) {
            if ($value_sub['parent_id'] == $id) {  
                $count++;
             }
           
        }
        if($count > 0){
        $this->html .= '<div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu">
                                    <div class="vmm-bg">
                                        <img class="img-fluid" src="../../assets/img/500X400/img1.png" alt="">
                                    </div>
                                    <div class="row u-header__mega-menu-wrapper">
                                        <div class="col mb-3 mb-sm-0">
                                            <span class="u-header__sub-menu-title">'.$category->category_name.'</span>
                                            <ul class="u-header__sub-menu-nav-group mb-3">';   
        foreach ($data_sub as $value_sub) {
            if ($value_sub['parent_id'] == $id) {  
                        
                $this->html .= '<li><a class="nav-link u-header__sub-menu-nav-link" href="http://127.0.0.1:8000/product/byCate/'.$value_sub['id'].'">'.$value_sub['category_name'].'</a></li>';    
                   
            }
           
        }
        $this->html .= '                   
                        </ul>
                    </div>
                </div>
            </div>';   
        }
        return $this->html;
     
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
    public function store(Request $request, $id)
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

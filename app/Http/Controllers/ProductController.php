<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\Order;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\Preview;
use App\Models\Product;
use App\Models\Category;
use App\Models\WishList;
use App\Models\Combinations;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\Image_Gallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Controllers\CategoryController;
use App\Models\ProductSpecificationsOptions;
use Illuminate\Console\View\Components\Alert;
use App\Models\ProductSpecificationsOptionsValue;
use App\Models\User;
use App\Models\User_addresses;

class ProductController extends Controller
{
    public function getProductCombi(Request $request) {
        $combistring = $request->get('combistring');
        $combistringReverse = $request->get('combistringReverse');
        $productCombi = Combinations::where('product_id', $request->get('product_id'))
        ->where(function ($query) use($combistring,  $combistringReverse) {
            $query->where('combination_string', 'like', "%$combistring%")
                ->orWhere('combination_string','like',  "%$combistringReverse%");
        })->first();

        if (!$productCombi || $productCombi->avilableStock <= 0) {
            return response()->json([
                'status' => 404,
                'message' => 'Phiên bản đã chọn đang tạm hết hàng'
            ]);
        }

        return response()->json([
            'status' => 200,
            'productCombi' => $productCombi
        ]);
    }
    public function search_product_by_cate()
    {
        $keywords = $_GET['key_cate_id'];
                $categories = Category::where('parent_id','<>',0)->get();
        $products = Product::where('category_id', '=', $keywords)->get();
        if (count($products) != 0) {
            return view('admin.products.list')->with(compact('products', 'categories'));
        } else if (count($products) == 0) {
            $products = Product::with('category')->orderBy('products.id', 'desc')->get();
            return view('admin.products.list')->with(compact('products', 'categories'));
        }
    }

    public function filter_view()
    {
        $keywords = $_GET['view_selected'];
                $categories = Category::where('parent_id','<>',0)->get();

        $products = Product::all();
        if ($keywords == 1) {
            $products = Product::with('category')->orderBy('products.product_view', 'desc')->get();
            return view('admin.products.list')->with(compact('products', 'categories'));
        } else if ($keywords == 2) {
            $products = Product::with('category')->orderBy('products.product_view', 'asc')->get();
            return view('admin.products.list')->with(compact('products', 'categories'));
        } else {
            $products = Product::with('category')->orderBy('products.id', 'asc')->get();
            return view('admin.products.list')->with(compact('products', 'categories'));
        }
    }

    public function filter_status(Request $request)
    {
        $keywords = $request['status_selected'];
        $categories = Category::where('parent_id','<>',0)->get();
        
        if ($keywords != 2) { 
            $products = Product::where('product_status', '=', $keywords)->get();
        } else {
            $products = Product::with('category')->get();
        }

        if (count($products) > 0){
            return view('admin.products.list')->with(compact('products', 'categories'));
        }else {
            $request->session()->now('message', 'Không có sản phẩm nào ở trạng thái này!');
            return view('admin.products.list')->with(compact('products', 'categories'));
        } 
    }

    public function search(Request $request)
    {
        $key_search = $request['key_search'];
        $categories = Category::where('parent_id','<>',0)->get();
        $products = Product::where('product_name' ,'LIKE', '%'.$key_search.'%')->get();
        if(count($products) >0 ){
            return view('admin.products.list')->with(compact('products', 'categories'));
        }else{
            $request->session()->now('message', 'Không có sản phẩm nào ở trạng thái này!');
            return view('admin.products.list')->with(compact('products', 'categories'));
        }
    }

    //lọc sản phẩm theo giá bán
    public function filter_price()
    {
        $banner = Banner::where('id', '9')->first();
        $bannerlist = Banner::where('id', '<>', '9')->get();
        $key_word = $_GET['select_price'];
        if($key_word == 1){
            $productFilter = Product::join('products_combinations', 'products.id', '=', 'products_combinations.product_id')
            ->select('products.product_name', 'products.product_img',DB::raw('min(products_combinations.price) as minprice'))
            ->groupBy('product_id')
            ->having('minprice', '<', '3000000')
            ->get();
        }elseif($key_word == 2){
            $productFilter = Product::join('products_combinations', 'products.id', '=', 'products_combinations.product_id')
            ->select('products.product_name', 'products.product_img',DB::raw('min(products_combinations.price) as minprice'))
            ->groupBy('product_id')
            ->having('minprice', '<', '5000000')
            ->get();
        }else{
            $productFilter = Product::join('products_combinations', 'products.id', '=', 'products_combinations.product_id')
            ->select('products.product_name', 'products.product_img',DB::raw('min(products_combinations.price) as minprice'))
            ->groupBy('product_id')
            ->having('minprice', '>', '5000000')
            ->get();
        }

        return view('client.products.product_filter', compact('productFilter','banner', 'bannerlist'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::where('parent_id','<>',0)->get();
        $products = Product::with('category')->orderBy('products.id', 'desc')->get();
        return view('admin.products.list', compact(['categories', 'products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cate = new CategoryController();
        $categorySelect = $cate->res(0);
        $specfications = ProductSpecificationsOptions::all();
        return view('admin.products.create', compact(['specfications', 'categorySelect']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();

        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;

        // Ảnh đại diện
        $imgpath = $_FILES['product_img']['name'];
        $target_dir = "../public/images/products/";
        $target_file =  $target_dir . basename($imgpath);
        move_uploaded_file($_FILES['product_img']['tmp_name'], $target_file);
        $product->product_img = $imgpath;
        $product->product_desc = $request->product_desc;
        $product->product_status = 1;
        $product->save();

        // Thư viện ảnh
        $name = array();
        $tmp_name = array();
        $error = array();
        $ext = array();
        $size = array();

        foreach ($_FILES['product_img_gallery']['name'] as $file) {
            $name[] = $file;
        }
        foreach ($_FILES['product_img_gallery']['tmp_name'] as $file) {
            $tmp_name[] = $file;
        }
        foreach ($_FILES['product_img_gallery']['error'] as $file) {
            $error[] = $file;
        }
        foreach ($_FILES['product_img_gallery']['type'] as $file) {
            $ext[] = $file;
        }
        foreach ($_FILES['product_img_gallery']['size'] as $file) {
            $size[] = round($file / 1024, 2);
        }
        //Phần này lấy giá trị ra từng mảng nhỏ
        for ($i = 0; $i < count($name); $i++) {
            $product_gallery = new Image_Gallery();
            $temp = preg_split('/[\/\\\\]+/', $name[$i]);
            $filename = $temp[count($temp) - 1];
            $upload_dir = "../public/images/products/";
            $upload_file = $upload_dir . $filename;
            move_uploaded_file($tmp_name[$i], $upload_file);
            $product_gallery->medium = $filename;
            $product_gallery->product_id = $product->id;
            $product_gallery->save();
        }

        $cateIdSeleted = $request->specification_cate;

        $specfications = ProductSpecificationsOptions::all();
        foreach ($specfications as $specfication) {
            if ($specfication->category_id == $cateIdSeleted) {
                $nspecfication = new ProductSpecificationsOptionsValue();

                $nspecfication_value = $specfication->id . "_value";
                $nspecification_name = $specfication->specification_name;

                $nspecfication->specification_name = $nspecification_name;
                $nspecfication->specification_value = $request->$nspecfication_value;
                $nspecfication->product_id = $product->id;

                $nspecfication->save();
            }
        }

        return redirect('/admin/product/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specfications = ProductSpecificationsOptions::all();
        $cate = new CategoryController();
        $categorySelect = $cate->res(0);
        $product = Product::with('specfications')->where('products.id', $id)->first();
        return view('admin.products.edit', compact(['product', 'categorySelect', 'specfications']));
    }

    public function hotfix($id) {
        $specfications = ProductSpecificationsOptions::all();
        $productId = $id;
        return view('admin.products.hotfix', compact('specfications', 'productId'));
    }
    public function hotfixUpdate(Request $request, $id) {
        $product = Product::find($id);
        $specfications = ProductSpecificationsOptions::all();
        foreach ($specfications as $specfication) {
                $nspecfication = new ProductSpecificationsOptionsValue();

                $nspecfication_value = $specfication->id . "_value";
                $nspecification_name = $specfication->specification_name;

                $nspecfication->specification_name = $nspecification_name;
                $nspecfication->specification_value = $request->$nspecfication_value;
                $nspecfication->product_id = $product->id;

                $nspecfication->save();
        }
        return 0;
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
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;

        $imgpath = $_FILES['product_img']['name'];
        if ($imgpath != '') {
            $target_dir = "../public/images/products/";
            $target_file =  $target_dir . basename($imgpath);
            move_uploaded_file($_FILES['product_img']['tmp_name'], $target_file);
            $product->product_img = $imgpath;
        }

        $product->save();

        $specfication_options = ProductSpecificationsOptions::where('category_id', $product->category_id)->get();

        foreach ($specfication_options as $specfication_option) {
            $specfication = ProductSpecificationsOptionsValue::where('product_id', $id)
                ->where('specification_name', 'LIKE', $specfication_option->specification_name)
                ->first();

            $nspecfication_value = $specfication->id . "_value";
            $specfication->specification_value = $request->$nspecfication_value;

            $nspecfication_value = $specfication->id . "_value";
            $specfication->specification_value = $request->$nspecfication_value;

            $specfication->save();
        }

        return redirect('/admin/product/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/admin/product/list');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllVariation($id)
    {
        $product = Product::with('combinations')->where('products.id', $id)->first();

        //    dd($product);
        return view('admin.products.variations', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productDetail($id)
    {
        $products = Product::find($id);
        $categories = Category::all();
        $previews = Preview::where('product_id',$id)->get();
        $slider = Slider::first()->orderBy('slider.created_at', 'DESC')->paginate(1);
        $banner = Banner::first()->orderBy('banner.created_at', 'DESC')->paginate(1);
        $product = Product::with(['category', 'variations', 'variation_value' , 'preview', 'combinations', 'images', 'specfications'])->where('products.id', $id)->first();
        $product->product_view+=1;
        $product->save();
        // dd($product->preview);
        $similarProducts = Product::with(['category'])
            ->where('products.category_id', $product->category_id)
            ->where('products.id', '!=', $id)
            ->take(6)
            ->get();
        $minPrice = $product->combinations{0}->price;
        $maxPrice = $product->combinations{0}->price;

        foreach ($product->combinations as $pro) {

            if($minPrice > $pro->price) {
                $minPrice = $pro->price;
            }

            if($maxPrice < $pro->price) {
                $maxPrice = $pro->price;
            }
        }

        $product['minprice'] = $minPrice;
        $product['maxprice'] = $maxPrice;
        $product['sku0'] = "...";
        $product['avilableStock0'] = "...";
        $countall = DB::table('product_reviews')->where('product_id','=',$product->id)->count();
        $count5 = DB::table('product_reviews')->where('product_id','=',$product->id)->where('status', '=', 5)->count();
        $count4 = DB::table('product_reviews')->where('product_id','=',$product->id)->where('status', '=', 4)->count();
        $count3 = DB::table('product_reviews')->where('product_id','=',$product->id)->where('status', '=', 3)->count();
        $count2 = DB::table('product_reviews')->where('product_id','=',$product->id)->where('status', '=', 2)->count();
        $count1 = DB::table('product_reviews')->where('product_id','=',$product->id)->where('status', '=', 1)->count();
        
        if ($countall > 0 ) {
            $total = ($count5*5 + $count4*4 + $count3*3 + $count2*2 + $count1*1)/$countall;
            $round =  round($total, 1);
            $previews = DB::table('product_reviews')->join('users','users.id','=','product_reviews.user_id')->select('product_reviews.*','users.name')->where('product_id','=',$product->id)->get();
            return view('client.products.product_details' , compact('product','previews', 'countall','count5','count4','count3','count2','count1', 'round', 'similarProducts' ));
        }
        else {
            $previews = DB::table('product_reviews')->join('users','users.id','=','product_reviews.user_id')->select('product_reviews.*','users.name')->where('product_id','=',$product->id)->get();
            return view('client.products.product_details' , compact('product','previews','countall','count5','count4','count3','count2','count1', 'similarProducts'));
        }    

        return view('client.products.product_details', compact('categories', 'slider', 'banner', 'products', 'previews','product', 'similarProducts'));
    }

    public function preview(Request $request, $id)
    {
        $previews = new Preview();
        $previews->rate = 5;
        $previews->review = $request->review;
        $previews->user_id = Auth::user()->id;
        $previews->product_id = $id;

        if ($request->rating_status > 0) {
            $previews->status = $request->rating_status;
        } else {
            $previews->status = 5;
        }

        $previews->save();
        return back();
    }


    public function deleteVariation($id, Request $request)
    {
        $del = Combinations::find($id);
        $idproduct = $del->product_id;
        $del->delete();
        return $this->getAllVariation($idproduct);
    }
    public function editAllVariation($id)
    {
        $detailVar = Combinations::find($id);
        $product = Product::with('combinations')->where('products.id', $id)->first();
        $variation = ProductSpecificationsOptions::find($id);
        return view('admin.variation.edit', compact('detailVar', 'product', 'variation'));
    }

    public function addToCart($id, Request $request)
    {
        $product = Combinations::find($id);
        $product_name_id = $product->product_id;
        $combi_id = $product->id;
        $productName = Product::find($product_name_id);
        $name = $productName->product_name;
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity_sp;
        } else {
            $cart[$id] = [
                "name" => $name . $product->combination_string,
                "quantity" => $request->quantity_sp,
                "price" => $product->price,
                "image" => $product->combination_image,
                'id_combi' => $combi_id,
            ];
        }
        session()->put('cart', $cart);
        return view('client.shop.cart')->with('success', 'Product added to cart');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCart($id_combi, Request $request)
    {
        $cart = session()->get(key: "cart");

        $cart[$id_combi]["quantity"] = $request->quantityNew;
        session()->put('cart', $cart);
        return view('client.shop.cart')->with('success', 'Product added to cart');
    }
    public function deleteCart($id_combi)
    {

        $carts = session()->get(key: "cart");
        unset($carts[$id_combi]);
        session()->put('cart', $carts);
        return view('client.shop.cart')->with('success', 'Product added to cart');
    }

    public function addToCompare($id){

        // $product_combi = Combinations::find($id);
        $product_combi = Combinations::with('product')->where('products_combinations.id', $id)->first();

        $product_spec = Product::with(['category', 'variations', 'variation_value', 'combinations', 'images', 'specfications'])
        ->where('products.id', $product_combi->product_id)->first()->specfications;

        $product_name_id = $product_combi->product_id;
        $productName = Product::find($product_name_id);
        $name = $productName->product_name;
        $product_compare_1 = session()->get('product_compare_1', []);
        $product_compare_1[$id] = [
            "id" => $id,
            "name" => $name . $product_combi->combination_string,
            "quantity" => $product_combi->avilableStock,
            "price" => $product_combi->price,
            "image" => $product_combi->combination_image,
            "sku" => $product_combi->sku,
           "specfications" => $product_spec,
        ];
        session()->put('product_compare_1', $product_compare_1);
        return view('client.shop.compare')->with('success', 'Product added to cart');

    }

    public function deleteCompare($id){
        $product_compare_1 = session()->get('product_compare_1', []);
        unset($product_compare_1[$id]);
        session()->put('product_compare_1', $product_compare_1);
        return view('client.shop.compare');

    }

    public function minPriceProduct($arrayPro) {

        foreach ($arrayPro as $pro) {
            $minPrice = $pro->combinations{0}->price;
            foreach ($pro->combinations as $item) {
                if($minPrice > $item->price) {
                    $minPrice = $item->price;
                }
            }

            $pro['minPrice'] = $minPrice;
        }

    }

    public function productbyCate($id, Request $request){
        $recommendProducts = Product::with(['category','combinations'])
        ->orderBy('products.product_view', 'desc')
        ->take(9)
        ->get();

        $productList = Product::with(['category','combinations'])
        ->where('products.category_id', $id)
        ->get();

        $latestProducts = Product::with(['category','combinations'])
        ->orderBy('products.id', 'desc')
        ->take(5)
        ->get();

        $categoryList = Category::with('products')->where('parent_id', '!=', '0')->get();
        
        foreach ($categoryList as $cate) {
            $countPro = count($cate->products);
            $cate['countPro'] = $countPro;
        }

        $this->minPriceProduct($recommendProducts);
        $this->minPriceProduct($productList);
        $this->minPriceProduct($latestProducts);
        $bannerlist = Banner::all();


        return view('client.products.product_ bycate', compact(['recommendProducts','productList','latestProducts', 'bannerlist', 'categoryList' ]));
    }


    public function searchProduct(Request $request) {
        $keyword = $request->keyword;
        $recommendProducts = Product::with(['category','combinations'])
        ->orderBy('products.product_view', 'desc')
        ->take(9)
        ->get();

        $productList = Product::with(['category','combinations'])
        ->where('products.product_name', 'LIKE', '%'.$keyword.'%')
        ->orderBy('products.id', 'desc')
        ->get();


        $latestProducts = Product::with(['category','combinations'])
        ->orderBy('products.id', 'desc')
        ->take(5)
        ->get();

        $this->minPriceProduct($recommendProducts);
        $this->minPriceProduct($productList);
        $this->minPriceProduct($latestProducts);


        return view('client.products.product_ bycate', compact(['recommendProducts','productList','latestProducts' ]));
    }





    public function addWishlist($id)
    {
        $user_id = Auth::user()->id;

        $checkIsset = false;
        $showWl = WishList::where("wishlists.user_id", $user_id)->get();
        $product = Combinations::with(['product'])
            ->where('products_combinations.id', $id)
            ->first();

        foreach ($showWl as $item) {

            if ($item->product_id == $product->id) {
                $checkIsset = true;
                break;
            }
        }
        if ($checkIsset) {
            return redirect()->route("listWishlist");
        }
        $productWishList = new WishList();
        $productWishList->name = $product->product->product_name. ' -' .$product->combination_string;
        $productWishList->image = $product->combination_image;
        $productWishList->price = $product->price;
        $productWishList->product_id  = $product->id;
        $productWishList->user_id  = Auth::user()->id;
        $productWishList->save();
        return redirect()->route("listWishlist");
    }
    public function showWishList()
    {
        $id = Auth::user()->id;
        $showWl = WishList::where("wishlists.user_id", $id)->get();
        return view('client.products.wishlist', compact("showWl"));
    }
    public function deleteWishList($id)
    {
        $product = WishList::find($id);
        $product->delete();
        return redirect()->route('listWishlist');
    }

    //Show my bill
    public function showMyBill ()
    {
        // $myBill = Order::with('orderdetail')->where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        $myBill = DB::table('orders')
                ->join('user_addresses', 'orders.address', '=', 'user_addresses.id')
                ->where('orders.user_id', Auth::id())
                ->select('orders.created_at', 'orders.total_amount', 'orders.phone', 'orders.status', 'orders.id', 'user_addresses.street', 'user_addresses.ward', 'user_addresses.district', 'user_addresses.city')
                ->get();
        return view('client.shop.mybill', compact('myBill'));
    }

    public function showBillDetail($id)
    {
        $billDetails = OrderDetails::where('order_id', $id)->get();
        foreach ($billDetails as $billdetail) {
            $productCombi = Combinations::find($billdetail->product_id);
            $productName = Product::find($productCombi->product_id)->value('product_name');
            $billdetail['product_combi'] = $productCombi;
            $billdetail['product_name'] = $productName;
        }
        return view('client.shop.billdetail', compact('billDetails'));
    }




}
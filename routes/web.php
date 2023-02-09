<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AddressControll;
use App\Http\Controllers\GoogleController;

use App\Http\Controllers\StatisticalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\CombinationsController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\PostReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleAdminController;
use App\Models\Order;
use GuzzleHttp\Handler\Proxy;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// -----------------------------------CLIENT-----------------------------


Route::prefix('/')->group(function () {
    Route::get('', [HomeController::class, 'index']);

    Route::prefix('/auth')->group(function () {
        Route::get('/google', [GoogleController::class, 'googleRedirect'])->name('google.redirect');
        Route::get('/google/callback', [GoogleController::class, 'googleLogin'])->name('google.login');
    });

    Route::prefix('/contact')->group(function () {
        Route::get('/', [ContactController::class, 'create']);
        Route::post('/', [ContactController::class, 'store']);
    });

    Route::prefix('/voucher')->group(function () {
        // Route::get('/', [VoucherController::class, 'list1']);
        Route::get('/', [VoucherController::class, 'list']);
        Route::post('/addVoucher', [VoucherController::class, 'addVoucher']);
        Route::get('/voucher_user', [UserController::class, 'voucher']);
        Route::post('/useCheckout', [CheckoutController::class, 'useCheckout']);
    });
    // Compare
    Route::prefix('/compare')->group(function () {
        Route::get('/', function () {
            return view('client.shop.compare');
        });
        Route::get('/add/{id}', [ProductController::class, 'addToCompare'])->name('compare.add');
        Route::get('/delete/{id}', [ProductController::class, 'deleteCompare'])->name('compare.delete');
    });


    //wishlist

    Route::get('/wishlist/{id}', [ProductController::class, 'addWishlist'])->name('addWishlist');
    Route::get('/listWishList', [ProductController::class, 'showWishList'])->name("listWishlist");
    Route::get('/deleteWishList/{id}', [ProductController::class, 'deleteWishList']);


    // Cart
    Route::prefix('/cart')->group(function () {
        Route::get('/', function () {
            return view('client.shop.cart');
        });
        Route::get('/add/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
        Route::get('/deleteCart/{id}', [ProductController::class, 'deleteCart'])->name('cart.remove');
        Route::post('/updateCart/{id}', [ProductController::class, 'updateCart'])->name('update.cart');
    });

    Route::prefix('/product')->group(function () {
        Route::get('/byCate/{id}', [ProductController::class, 'productbyCate']);
        Route::get('/detail/{id}', [ProductController::class, 'productDetail']);
        //review product
        Route::post('/preview/{id}', [ProductController::class, 'preview'])->name('preview');
        // Route::get('/rate/{id}',[ProductController::class,'reviewRate']);
        Route::get('/search', [ProductController::class, 'searchProduct']);
        Route::get('/filter_price', [ProductController::class, 'filter_price'])->name('filter_price');
        Route::get('/combi', [ProductController::class, 'getProductCombi']);
    });

    Route::prefix('/user')->group(function () {
        Route::get('/{id}', [UserController::class, 'show']);
        Route::get('/update/{id}', [UserController::class, 'useredit']);
        Route::post('/update/{id}', [UserController::class, 'userupdate']);

        Route::get('/showaddress/{id}', [AddressControll::class, 'show']);
        Route::get('/createaddress/{user_id}', [AddressControll::class, 'create']);
        Route::post('/createaddress', [AddressControll::class, 'store']);
        Route::get('/updateaddress/{user_id}', [AddressControll::class, 'edit']);
        Route::post('/updateaddress', [AddressControll::class, 'update']);

        Route::get('/delete/{id}', [AddressControll::class, 'destroy']);

        Route::get('/updatepass/{id}', [UserController::class, 'passedit']);
        Route::post('/updatepass/{id}', [UserController::class, 'passupdate']);
    });

    Route::prefix('/blogs')->group(function () {

        Route::get('/', [PostController::class, 'getAllPost']);
        // lay tat ca bai viet theo danh muc
        Route::get('/list/{id}', [PostController::class, 'getPostById']);

        Route::get('/details/{id}', [PostController::class, 'showclient']);

        //review blogs
        Route::get('/detail/{id}', [PostReviewController::class, 'showclient']);
        Route::post('/review/{id}', [PostReviewController::class, 'reviewPost'])->name('post_review');
    });
    // Đơn hàng của bạn
    Route::prefix('/bill')->group(function () {
        Route::get('/list', [ProductController::class, 'showMyBill'])->name('bill.list')->middleware('checkBill');
        Route::get('/detail/{id}', [ProductController::class, 'showBillDetail'])->name('bill.show_detail');
    });

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/done', [CheckoutController::class, 'store'])->name('done');

    // Cổng thanh toán
    Route::post('/vnpay_payment', [CheckoutController::class, 'vnpay_payment']);
});


// -----------------------------------ADMIN-----------------------------
Route::middleware(['auth','isAdmin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/', [StatisticalController::class, 'index']);

        Route::prefix('/category')->group(function () {
            Route::get('/list', [CategoryController::class, 'index']);
            Route::get('/create', [CategoryController::class, 'create']);
            Route::post('/create', [CategoryController::class, 'store']);
            Route::get('/update/{id}', [CategoryController::class, 'edit']);
            Route::post('/update/{id}', [CategoryController::class, 'update']);
            Route::get('/delete/{id}', [CategoryController::class, 'destroy']);

            // Filter
            Route::get('/level', [CategoryController::class, 'level'])->name('level_cate');
            Route::get('/filter_name', [CategoryController::class, 'filter_name'])->name('filter_name_cate');
            Route::get('/search', [CategoryController::class, 'search'])->name('search_cate');
        });

        Route::prefix('/product')->group(function () {
            Route::get('/hotfix/{id}', [ProductController::class, 'hotfix']);
            Route::post('/hotfix/{id}', [ProductController::class, 'hotfixUpdate']);

            Route::get('/searchproduct', [ProductController::class, 'search'])->name('search');

            Route::get('/search_product_by_cate', [ProductController::class, 'search_product_by_cate'])->name('search_product_by_cate');
            Route::get('/filter_view', [ProductController::class, 'filter_view'])->name('filter_view_product');
            Route::get('/filter_status', [ProductController::class, 'filter_status'])->name('filter_status_product');
            Route::get('/search', [ProductController::class, 'search'])->name('search_product');
            // Route::get('/list', [ProductController::class, 'index']);

            Route::get('/list', [ProductController::class, 'index'])->name('product.list');

            Route::get('/list', [ProductController::class, 'index']);

            Route::get('/create', [ProductController::class, 'create']);
            Route::post('/create', [ProductController::class, 'store']);

            Route::get('/edit/{id}', [ProductController::class, 'edit']);
            Route::post('/update/{id}', [ProductController::class, 'update']);
            Route::get('/delete/{id}', [ProductController::class, 'destroy']);


            Route::get('/addVariation/{id}', [VariationController::class, 'create']);
            Route::post('/addVariation', [VariationController::class, 'store']);

            Route::get('/listVariation/{id}', [VariationController::class, 'viewList']);

            Route::get('/test/{id}', [VariationController::class, 'test']);
            Route::get('/listProVar/{id}', [ProductController::class, 'getAllVariation'])->name('combination.list');
            Route::get('/editProVar/{id}', [ProductController::class, 'editAllVariation']);
            Route::post('/editProVar/{id}', [ProductController::class, 'editDoneVariation']);
            Route::get('/deleteProvar/{id}', [ProductController::class, 'deleteVariation']);
        });

        Route::prefix('/specification')->group(function () {
            Route::get('/list', [SpecificationController::class, 'index'])->name('specification.list');
            Route::get('/create', [SpecificationController::class, 'create'])->name('specification.create');
            Route::post('/create', [SpecificationController::class, 'store'])->name('specification.create_process');
            Route::get('/update/{id}', [SpecificationController::class, 'edit'])->name('specification.edit');
            Route::post('/update/{id}', [SpecificationController::class, 'update'])->name('specification.edit_process');
            Route::get('/delete/{id}', [SpecificationController::class, 'destroy']);
        });

        Route::prefix('/variation_main')->group(function () {
            Route::get('/list', [VariationController::class, 'index'])->name('variation_main.list');

            Route::get('/create', [VariationController::class, 'create_main'])->name('variation_main.create');
            Route::post('/create', [VariationController::class, 'store_main'])->name('variation_main.create_process');

            Route::get('/edit/{id}', [VariationController::class, 'edit_main'])->name('variation_main.edit');
            Route::post('/update/{id}', [VariationController::class, 'update_main'])->name('variation_main.edit_process');

            Route::get('/delete/{id}', [VariationController::class, 'destroy_main']);
        });

        Route::get('/delete/{id}', [VariationController::class, 'destroy_main']);

        Route::prefix('/specification')->group(function () {
            Route::get('/list', [SpecificationController::class, 'index'])->name('specification.list');
            Route::get('/create', [SpecificationController::class, 'create'])->name('specification.create');
            Route::post('/create', [SpecificationController::class, 'store'])->name('specification.create_process');
            Route::get('/update/{id}', [SpecificationController::class, 'edit'])->name('specification.edit');
            Route::post('/update/{id}', [SpecificationController::class, 'update'])->name('specification.edit_process');
            Route::get('/delete/{id}', [SpecificationController::class, 'destroy']);

            Route::get('/search', [SpecificationController::class, 'search'])->name('search_spe');
            Route::get('/spe_name', [SpecificationController::class, 'name'])->name('spe_name');
            Route::get('/search_specate', [SpecificationController::class, 'category'])->name('category');
        });

        Route::prefix('/variation_main')->group(function () {
            Route::get('/list', [VariationController::class, 'index'])->name('variation_main.list');

            Route::get('/create', [VariationController::class, 'create_main'])->name('variation_main.create');
            Route::post('/create', [VariationController::class, 'store_main'])->name('variation_main.create_process');

            Route::get('/edit/{id}', [VariationController::class, 'edit_main'])->name('variation_main.edit');
            Route::post('/update/{id}', [VariationController::class, 'update_main'])->name('variation_main.edit_process');

            Route::get('/search', [PostController::class, 'search']);

            Route::get('/delete/{id}', [VariationController::class, 'destroy_main']);
        });

        Route::prefix('/post')->group(function () {
            Route::get('/list', [PostController::class, 'index']);

            Route::get('/create', [PostController::class, 'create']);
            Route::post('/create', [PostController::class, 'store']);

            Route::get('/edit/{id}', [PostController::class, 'edit']);
            Route::post('/update/{id}', [PostController::class, 'update']);

            Route::get('/details/{id}', [PostController::class, 'show']);

            Route::get('/delete/{id}', [PostController::class, 'destroy']);

            //tìm kiếm và lọc bài viết
            Route::get('/searchpost', [PostController::class, 'searchs'])->name('searchs');
            Route::get('/filter_view', [PostController::class, 'filter_views'])->name('filter_views');
            Route::get('/filter_status', [PostController::class, 'filter_statuss'])->name('filter_statuss');
        });

        Route::prefix('/preview')->group(function () {
            Route::get('/list', [PreviewController::class, 'index']);
            Route::get('/detail/{id}', [PreviewController::class, 'show']);
            Route::get('/delete/{id}', [PreviewController::class, 'destroy']);
            Route::get('/filter-preview-date', [PreviewController::class, 'filterPreviewByDate'])->name('preview.filter');
        });

        Route::prefix('/contact')->group(function () {
            Route::get('/list', [ContactController::class, 'index']);
        });

        Route::prefix('/user')->middleware('CheckSeniorAdmin')->group(function () {
            Route::get('/list', [UserController::class, 'index']);
            Route::get('/edit/{id}', [UserController::class, 'edit']);
            Route::put('/update/{id}', [UserController::class, 'update']);
        });

        Route::get('/search', [PostController::class, 'search']);

        Route::prefix('/order')->group(function () {
            Route::get('/list', [OrderController::class, 'index']);
            Route::get('/details/{id}', [OrderDetailsController::class, 'show']);
            Route::get('/edit/{id}', [OrderController::class, 'edit']);
            Route::put('/update/{id}', [OrderController::class, 'update']);
            Route::get('/filter-status-order', [OrderController::class, 'filter_status_order'])->name('filter.status.order');
        });

        Route::prefix('/stocks')->group(function () {
            Route::get('/list', [StocksController::class, 'index']);
            Route::get('/stock_detail/{id}', [StocksController::class, 'show']);
            Route::get('/search', [StocksController::class, 'search'])->name('search_stock');
            Route::get('/stock_name', [StocksController::class, 'name'])->name('stock_name');
            Route::get('/price', [StocksController::class, 'price'])->name('price');
        });

        Route::prefix('/slider')->group(function () {
            Route::get('/list', [SliderController::class, 'index'])->name('slider.list');
            Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
            Route::post('/create', [SliderController::class, 'store'])->name('slider.create_process');
            Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
            Route::post('/edit/{id}', [SliderController::class, 'update'])->name('slider.edit_process');
            Route::get('/delete/{id}', [SliderController::class, 'destroy']);
        });

        Route::prefix('/banner')->group(function () {
            Route::get('/list', [BannerController::class, 'index'])->name('banner.list');
            Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
            Route::post('/create', [BannerController::class, 'store'])->name('banner.create_process');
            Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
            Route::post('/edit/{id}', [BannerController::class, 'update'])->name('banner.edit_process');
            Route::get('/delete/{id}', [BannerController::class, 'destroy']);
        });

        Route::prefix('/voucher')->group(function () {
            Route::get('/list', [VoucherController::class, 'index'])->name('voucher.list');
            Route::get('/create',  [VoucherController::class, 'create']);
            Route::post('/create', [VoucherController::class, 'store'])->name('voucher.create');
            Route::get('/edit/{id}', [VoucherController::class, 'edit']);
            Route::post('/update/{id}', [VoucherController::class, 'update']);
            Route::get('/delete/{id}', [VoucherController::class, 'destroy']);
        });

        Route::prefix('/payment')->group(function () {
            Route::get('/list', [PaymentController::class, 'index'])->name('payment.list');
            Route::get('/create',  [PaymentController::class, 'create']);
            Route::post('/create', [PaymentController::class, 'store'])->name('payment.create');
            Route::get('/edit/{id}', [PaymentController::class, 'edit']);
            Route::post('/update/{id}', [PaymentController::class, 'update']);
            Route::get('/delete/{id}', [PaymentController::class, 'destroy']);
        });

        Route::prefix('/statistical')->group(function () {
            Route::get('/', [StatisticalController::class, 'getAllStatisticals'])->name('statistical.list');
            Route::get('/list', [StatisticalController::class, 'getStatistical']);
        });

        // Phan quyen
        Route::prefix('/permission')->middleware('checkStaff')->group(function () {
            Route::get('/', [PermissionController::class, 'index']);
            Route::get('/create', [PermissionController::class, 'create']);
            Route::post('/create', [PermissionController::class, 'store']);
            Route::get('/delete/{id}', [PermissionController::class, 'destroy']);
        });

        Route::prefix('/role')->middleware('checkAdminFull')->group(function () {
            Route::get('/create', [RoleAdminController::class, 'create']);
            Route::get('/list', [PermissionController::class, 'getStatistical']);
            Route::post('/create', [RoleAdminController::class, 'store']);
        });
     
               
    });
});         
require __DIR__ . '/auth.php';
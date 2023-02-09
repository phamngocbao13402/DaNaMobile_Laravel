<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditVariationRequest;
use App\Http\Requests\StoreVariationRequest;
use App\Models\Product;
use App\Models\Variation;
use App\Models\Variation_Option;
use App\Models\Variation_Option_Value;
use App\Models\Combinations;
use App\Models\Image_Gallery;

use Illuminate\Http\Request;

class VariationController extends Controller
{

    // Main Variation
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variations = Variation::all();
        // $result = $variation::all();

        return view('admin.variation_main.list', compact('variations'));
    }

    public function create_main(){
        return view('admin.variation_main.create');
    }

    public function store_main(StoreVariationRequest $request){
        $variation = new Variation();
        $variation->variation_name = $request['variation_name'];
        $variation->save();
        return redirect()->route('variation_main.list');
    }

    public function edit_main($id)
    {
        $variation = Variation::find($id);
        return view('admin.variation_main.edit', compact('variation'));
    }

    public function update_main(EditVariationRequest $request, $id)
    {
        $variation = Variation::find($id);
        $variation->variation_name = $request['variation_name'];
        $variation->save();

        return redirect()->route('variation_main.list')->with('success', 'Sửa thành công');
    }

    public function destroy_main($id)
    {
        $variation = Variation::find($id);
        $variation->delete();
        return redirect()->route('variation_main.list');
    }
    /**
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function test($id)
    {
        $product = Product::find($id);
        $variations = Variation_Option::with('variation_values')->get();
        dd($variations);
        // return view('admin.variation.create', compact(['product', 'variations']));
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::find($id);
        $variations = Variation::all();
        return view('admin.variation.create', compact(['product', 'variations']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::with(['variations', 'images'])->where('products.id',$request->product_id )->first();

        $productVariationsValues = Product::with('variation_value')->where('products.id',$request->product_id )->first();
    
        $variations = Variation::all();

        $combination_string = '';


        $checkProductVariation = $product->variations;
  
        if(count($checkProductVariation) == 0) {
            foreach ($variations as $variation) {
                
                $variation_option = new Variation_Option();
            
                $variation_option->variation_name =  $variation->variation_name;
                $variation_option->product_id =  $request->product_id;
    
                $variation_option->save();
    
                $variation_option_value = new Variation_Option_Value();
    
                $variation_option_value->variation_name = $variation->variation_name;
                $inputRequestValue = $variation->id . "_value";
    
                $variation_option_value->variation_value = $request->$inputRequestValue;
                
                $variation_option_value->products_variation_id = $variation_option->id;

                $combination_string =$combination_string. ' '.$request->$inputRequestValue;
    
                $variation_option_value->save();
            }
        }else {
            foreach ($variations as $variation) {
                $id = '';
                foreach ($product->variations as $pvariation) {
                    if($pvariation->variation_name == $variation->variation_name) {
                        $id = $pvariation->id;
                    }
                }

                $rom = $request->variation_rom;
            
                $variation_option_value = new Variation_Option_Value();

                $variation_option_value->variation_name = $variation->variation_name;
                $inputRequestValue = $variation->id . "_value";

                $variation_option_value->variation_value = $request->$inputRequestValue;
                
                $variation_option_value->products_variation_id =$id;

                $combination_string =$combination_string. ' '.$request->$inputRequestValue;

                $variation_option_value->save();
                
            }

        }
       

        $newCombination = new Combinations();

        $newCombination -> combination_string = $combination_string;
        $file_name = $request->combination_image->getClientoriginalName();
        $request->combination_image->move(public_path('images/products'), $file_name);
        $newCombination -> combination_image = $file_name;

        $isIssetImg = false;

        foreach ($product->images as $productImage) {
            if($productImage->medium == $file_name) {
                $isIssetImg = true;
                break;
            }
        }

        if(!$isIssetImg) {
            $newImgPro = new Image_Gallery();

            $newImgPro -> medium = $file_name;
            $newImgPro -> product_id =  $request->product_id;

            $newImgPro -> save();

        }

        $newCombination -> sku = $request->sku;
        $newCombination -> price = $request->price;
        $newCombination -> sale = $request->sale;
        $newCombination -> avilableStock = $request->avilableStock;
        $newCombination ->product_id =  $request->product_id;


        $newCombination->save();

        return redirect('/admin/product/list');
    }


    // View list Variation by Product
    public function viewList(Request $request, $id){
        $list_Variations = Product::with('variation_value')->where('products.id',$id )->first();
        dd( $list_Variations );
        // $variation_option_value = Variation::with('variation_values')->where('')
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

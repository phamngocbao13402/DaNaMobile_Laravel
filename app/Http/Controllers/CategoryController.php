<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
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
        foreach ($categories as $category) {
            $parent_id = $category->parent_id;
            $partenCateName = $this->getCategoryName($parent_id);
            $category['parent_cate'] = $partenCateName;
        }
        return view('admin.categories.list', compact('categories'));

    }
    public function getCategoryName($id) {
        if($id != 0) {
            $category = Category::find($id);
            return $category->category_name;
        }else{
            return 'Danh mục cha';
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorySelect = $this->res(0);
        return view('admin.categories.create', compact('categorySelect'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $cate = new Category();
        $categories = Category::all();
        $cate->category_name = $request['category_name'];
        $imgpath = $_FILES['category_image']['name'];
        if ($imgpath != '') {
            $target_dir = "../public/images/categories/";
            $target_file =  $target_dir . basename($imgpath);
            move_uploaded_file($_FILES['category_image']['tmp_name'], $target_file);
            $cate->category_image = $imgpath;
        }

        $cate->parent_id = $request['parent_id'];
        $cate->save();

        // Category::create($request->all());
        $categorySelect = $this->res(0);
        return $this->index();
        //return redirect('/admin/categories/list', compact('categories'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        // $cate -> parent_id = $request['parent_id'];
        $categorySelect = $this->res_selected(0, $category->parent_id, $id);
        return view('admin.categories.edit', compact('categorySelect', 'category'));
    }

    function res_selected($i, $parent_id, $id, $text = '')
    {
        $data = Category::all();
        foreach ($data as $value) {
            if ($value['parent_id'] == $i) {
                if ($value['id'] == $parent_id) {
                    if ($value['id'] == $id) {
                        $this->html .= '<option value="' . $value['id'] . '" style="display: none;">' . $text . $value['category_name'] . '</option>';
                        $this->res_selected($value['id'], $parent_id, $id, $text . '--');
                    } else {
                        $this->html .= '<option value="' . $value['id'] . '" selected>' . $text . $value['category_name'] . '</option>';
                        $this->res_selected($value['id'], $parent_id, $id, $text . '--');
                    }
                } else {
                    if ($value['id'] == $id) {
                        $this->html .= '<option value="' . $value['id'] . '" style="display: none;">' . $text . $value['category_name'] . '</option>';
                        $this->res_selected($value['id'], $parent_id, $id, $text . '--');
                    } else {
                        $this->html .= '<option value="' . $value['id'] . '" >' . $text . $value['category_name'] . '</option>';
                        $this->res_selected($value['id'], $parent_id, $id, $text . '--');
                    }
                }
            }
        }
        return $this->html;
    }

    function res_selected1($parent_id, $text = '')
    {
        $data = Category::all();
        foreach ($data as $value) {
            if ($value['parent_id'] == $parent_id) {
                $this->html .= '<option value="' . $value['id'] . '">' . $text . $value['category_name'] . '</option>';
                $this->res($value['id'], $text . '--');
            }
        }
        return $this->html;
    }


    public function res($id, $text = '')
    {
        $data = Category::all();
        foreach ($data as $value) {
            if ($value['parent_id'] == $id) {
                $this->html .= '<option id="' . $value['parent_id'] . '" value="' . $value['id'] . '">' . $text . $value['category_name'] . '</option>';
                $this->res($value['id'], $text . '--');
            }
        }
        return $this->html;
    }

    public function res_selected_category($id, $text = ''){
        $data = Category::all();
        // dd($id, $text);
        foreach ($data as $value) {
            if($value['id'] == $id) {
                $this->html .= '<option  value="' . $value['id'] . '" selected>' . $text . $value['category_name'] . '</option>';
                $this->res($value['id'], $text . '--');
            }else{
                $this->html .= '<option value="' . $value['id'] . '">' . $text . $value['category_name'] . '</option>';
                $this->res($value['id'], $text . '--');
            }
        }
        return $this->html;
    }

    public function res_delete_parent($id, $text = ''){
        $data = Category::all();
        foreach ($data as $value) {
            if ($value['parent_id'] != $id) {
                $this->html .= '<option id="'.$value['parent_id'].'" data-parent="'.$value['parent_id'].'" value="' . $value['id'] . '">' . $text . $value['category_name'] . '</option>';
                //$this->res($value['id'], $text . '-1-');
            }
        }
        return $this->html;
    }

    public function res_delete_children($id, $text = ''){
        $data = Category::all();
        foreach ($data as $value) {
            if ($value['parent_id'] == $id) {
                $this->html .= '<option value="' . $value['id'] . '">' . $text . $value['category_name'] . '</option>';
                //$this->res($value['id'], $text . '-1-');
            }
        }
        return $this->html;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCategoryRequest $request, $id)
    {
        $cate =  Category::find($id);
        $cate->category_name = $request->category_name;
        $cate->parent_id = $request->parent_id;

        $imgpath = $_FILES['category_image']['name'];

        if ($imgpath != '') {
            $target_dir = "../public/images/categories/";
            $target_file =  $target_dir . basename($imgpath);
            move_uploaded_file($_FILES['category_image']['tmp_name'], $target_file);
            $cate->category_image = $imgpath;
        }

        $cate->save();
        $categorySelect = $this->res(0);

        return $this->index();


        // $categories = Category::all();
        // return view('admin.categories.list', compact('categorySelect'), ['categoryList' => $categories]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $category = Category::find($id);
        // $category->delete();
        // $this->deleteRes($id);
        // return $this->index();
        $category = Category::find($id);
        $categories = Category::all();
        $i = 0;
        foreach ($categories as $key) {
            // dd($key['parent_id']);
            if ( $key['parent_id'] == $id) {
                $i++;
            }
        }
        if ( $i != 0) {
            
            return $this->index()->with('message' , ' thêm sản phẩm thành công' );
        }else{
        $category->delete();
        return $this->index()->with('success', 'Thêm thành công');
        }
        
       
    }

    public function deleteRes($id)
    {
        $category = Category::find($id);
        $category->delete();
        $categories = Category::all();
        foreach ($categories as $key) {
            if ($key['parent_id'] == $id) {
                $cate = Category::find($categories['id']);
                $cate->delete();
            }else{
                echo '<script type="text/javascript> alert("Bạn không thể xoá sản phẩm cha!") </script>';
            }
        }
        return $this->index();
    }

    // Filter and search categories

    public function level(Request $request){
        $key = $request['level'];      
        if($key == 0){
            $categories = Category::all();
            foreach ($categories as $category) {
                $parent_id = $category->parent_id;
                $partenCateName = $this->getCategoryName($parent_id);
                $category['parent_cate'] = $partenCateName;
            }
        }else if( $key == 1){
            $categories = Category::where("parent_id", 0)->get();
        }else{
            $categories = Category::where("parent_id","<>", 0)->get();
            foreach ($categories as $category) {
                $parent_id = $category->parent_id;
                $partenCateName = $this->getCategoryName($parent_id);
                $category['parent_cate'] = $partenCateName;
            }
        }
        if (count($categories) > 0){
            return view('admin.categories.list', compact('categories'));
        }else {
            $request->session()->now('message', 'Không có danh mục nào thuộc loại này!');
            return view('admin.categories.list', compact('categories'));
        }  
       
    }

    public function filter_name(){
        $key = $_GET['filter_name'];      
        if($key == 0){
            $categories = Category::all();
            foreach ($categories as $category) {
                $parent_id = $category->parent_id;
                $partenCateName = $this->getCategoryName($parent_id);
                $category['parent_cate'] = $partenCateName;
            }
            return view('admin.categories.list', compact('categories'));
        }else if( $key == 1){
            
            $categories = Category::orderBy("category_name", "DESC")->get();
            foreach ($categories as $category) {
                $parent_id = $category->parent_id;
                $partenCateName = $this->getCategoryName($parent_id);
                $category['parent_cate'] = $partenCateName;
            }
            return view('admin.categories.list', compact('categories'));
        }else{
            $categories = Category::orderBy("category_name", "ASC")->get();

            foreach ($categories as $category) {
                $parent_id = $category->parent_id;
                $partenCateName = $this->getCategoryName($parent_id);
                $category['parent_cate'] = $partenCateName;
            }
            return view('admin.categories.list', compact('categories'));
        }       
    }

    public function search(){
        $keyword = $_GET['key_search'];
        $categories = Category::where('category_name','LIKE', '%' . $keyword . '%')->get();
        foreach ($categories as $category) {
            $parent_id = $category->parent_id;
            $partenCateName = $this->getCategoryName($parent_id);
            $category['parent_cate'] = $partenCateName;
        }
        return view('admin.categories.list', compact('categories'));
    }
}
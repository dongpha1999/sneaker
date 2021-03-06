<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.listCategory',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.addCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'category-name' => 'required'
        ]);
        //  Store data in database
        $category = new Category([
            'title' => $request->input('category-name')
        ]);
        $category->save();
        return redirect()->route('category.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = DB::select('select * from products where category_id = :id', ['id' => $id]);
        $categories = DB::table('categories')->where('status','=',1)->get();
        $category = Category::find($id);
        return view('product-category',['products' => $products,'categories' => $categories,'category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.editCategory',['category' => $category]);
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
        $category = Category::find($id);
        $category->title = $request->input('category-name');
        $category->save();
        return redirect()->route('category.list')->with("success","S???a th??nh c??ng");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = DB::select('select * from products where category_id = :id', ['id' => $id]);
        if (is_array($check)) {
            if (count($check) > 0) {
                return back()->with("invalid", "Hi???n c?? m???t s??? s???n ph???m ??ang c?? danh m???c n??y");
            }
            else{
                $category = Category::find($id);
                $category->delete();
                return redirect()->route('category.list')->with("success","X??a th??nh c??ng");
            }
        }
    }

    /**
     * Disable status category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
        return redirect()->route('category.list')->with("success","V?? hi???u h??a th??nh c??ng");
    }

    /**
     * Enable status category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function enable($id)
    {
        $category = Category::find($id);
        $category->status = 1;
        $category->save();
        return redirect()->route('category.list')->with("success","M??? th??nh c??ng");
    }
}

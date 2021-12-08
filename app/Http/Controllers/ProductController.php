<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->select('products.*', 'categories.c_name')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('admin.product.show',compact('products'));
    }

    public function create()
    {
        $category=Category::all();
        return view('admin.product.create',compact('category'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'num_pice'=>'required',
            'detail'=>'required',
            'category'=>'required',
            ]);
        $product=Product::create($request->all());
        return redirect()->route('admin.product.show')
        ->with('success',"تم أضافة المنتج بنجاح");
    }

    public function show(Product $product)
    {
        return view('admin.product.show',compact('product'));
    }
    public function edit($id)
    {
        $product =Product::find($id);
        $category_name=Category::find($product->category);
        $category=Category::all();
        return view('admin.product.edit')
        ->with(compact('product'))
        ->with(compact('category'))
        ->with(compact('category_name'))
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'num_pice'=>'required',
            'detail'=>'required',
            'category'=>'required',
            ]);
        $data = $request->all();
        Product::find($id)->update($data);
        return redirect()->route('admin.product.show')
        ->with('success',"تم تحديث المنتج بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $delete = Product::find($product);
        $delete->delete();
        
        return redirect()->route('admin.product.show')
        ->with('success',"تم حذف المنتج بنجاح");
    }
}

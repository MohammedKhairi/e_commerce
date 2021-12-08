<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->select('products.*', 'categories.c_name')
            ->orderBy('id', 'DESC')
            ->paginate(8);
            //->get();
        $categories=Category::all();
        return view('home',
        compact('products'),
        compact('categories')
        );
    }
    public function show_product($id)
    {
        
            if($product = Product::find($id))
            {
                $product = DB::table('products')
                ->join('categories', 'products.category', '=', 'categories.id')
                ->select('products.*', 'categories.c_name')
                ->where('products.id',$id)
                ->get();
                 $categories=Category::all();
                return view('product',compact('product'),compact('categories'));
            }
            else
            {
                return redirect()->back();
            }
        
    }
    public function show_comment($id)
    {
        $commentes = DB::table('comments')
            ->join('products', 'comments.product_id', '=', 'products.id')
            ->where('products.id',$id)
            ->select('comments.*')
            ->orderBy('id', 'DESC')
            ->get();
            $replays = DB::table('replays')
            ->join('comments', 'replays.comment_id', '=', 'comments.id')
            ->select('replays.*')
            ->orderBy('id', 'DESC')
            ->get();
        return response()->json([
            'status'=>200,
            'commentes'=> $commentes,
            'replays'=> $replays,
        ]);
        
    }
    public function related_product($id)
    {
        $related = DB::table('products')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->where('products.name','like',"%$id%")
            ->orWhere('categories.c_name', 'like', "%$id")
            ->select('products.*', 'categories.c_name')
            ->orderBy('id', 'DESC')
            ->skip(0)
            ->take(3)
            ->get();
        return response()->json([
            'status'=>200,
            'related'=> $related,
        ]);
    }
    public function category_product($cate)
    {

        $cate_name = DB::table('categories')
        ->where('c_name',$cate)
        ->select('c_name')
        ->get();
        if($cate_name->isEmpty())
        {
            return redirect()->back();
            
        }
        $products = DB::table('products')
        ->join('categories', 'products.category', '=', 'categories.id')
        ->where('categories.c_name',$cate)
        ->select('products.*', 'categories.c_name')
        ->orderBy('id', 'DESC')
        ->paginate(8);
        //->get();
        
        //return $cate_name;
        $categories=Category::all();
        return view('category')->
        with([
            'products'=>$products,
            'cate_name'=>$cate_name,
            'categories'=>$categories
        ]);
    }
    public function search($id)
    {
       // $id = $request->input('search');
       if(is_null($id)||is_null($id)==" ")
       {
        return response()->json([
            'status'=>404,
        ]);
       }
       else {
        $products = DB::table('products')
        ->join('categories', 'products.category', '=', 'categories.id')
        ->where('products.name','LIKE',"%$id%")
        ->orWhere('categories.c_name', 'LIKE', "%$id")
        ->select('products.*', 'categories.c_name')
        ->orderBy('id', 'DESC')
        ->get();
        return response()->json([
            'status'=>200,
            'products'=> $products,
        ]);
       }
        
    }
    public function aboutus()
    {
        $categories=Category::all();
        return view('aboutus',compact('categories'));
    }
    public function contactus()
    {
        $categories=Category::all();
        return view('contactus',compact('categories'));
        
    }
    public function privcy()
    {
        $categories=Category::all();
        return view('privcy',compact('categories'));
        
    }
}

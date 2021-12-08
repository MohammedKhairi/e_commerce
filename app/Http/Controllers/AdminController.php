<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
            ->orderBy('products.id', 'desc')

            ->skip(0)->take(5)
            ->get();
            $commentes = DB::table('comments')
            ->join('products', 'comments.product_id', '=', 'products.id')
            ->select('comments.*', 'products.name as p_name')
            ->where('comments.state',"0")
            ->orderBy('comments.id', 'desc')
            ->skip(0)->take(5)
            ->get();
        return view('admin.dashboard',compact('products'),compact('commentes'));
    }
    public function count_project()
    {  

        $products_number = DB::table('products')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->get()
            ->count();
        $commentes_number = DB::table('comments')
            ->join('products', 'comments.product_id', '=', 'products.id')
            ->where('comments.state',"0")
            ->get()
            ->count();
        $orders_number = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.state',"0")
            ->get()
            ->count();
      
            $content_number= array($products_number, $commentes_number, $orders_number);
            return $content_number;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $admin = User::find( Auth::user()->id);
        return view('admin.show',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'phone'=>'required',
            'adress'=>'required',
            ]);
        $data = $request->all();
        User::find(Auth::user()->id)->update($data);
        return redirect()->route('admin.show')
        ->with('success',"تم تحديث المعلومات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}

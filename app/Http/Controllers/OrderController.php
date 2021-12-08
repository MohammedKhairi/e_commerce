<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // public function __construct()
    // {
    //     $products_number = DB::table('products')
    //         ->join('categories', 'products.category', '=', 'categories.id')
    //         ->get()
    //         ->count();
    //     $commentes_number = DB::table('comments')
    //         ->join('products', 'comments.product_id', '=', 'products.id')
    //         ->where('comments.state',"0")
    //         ->get()
    //         ->count();
    //     $orders_number = DB::table('orders')
    //         ->join('products', 'orders.product_id', '=', 'products.id')
    //         ->where('orders.state',"0")
    //         ->get()
    //         ->count();
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'products.name as p_name','users.name as u_name')
            ->where('orders.state',"0")
            ->paginate(10);
        return view('admin.order.show',compact('orders'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*', 'products.name as p_name','products.price','users.name as u_name')
        ->where('orders.id',$id)
        ->where('orders.state',"0")
        ->get();
        return view('admin.order.display',compact('order'));
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
        $delete = Order::find($id);
        $delete->delete();
        return redirect()->route('admin.order.show')
        ->with('success',"تم حذف الطلب بنجاح");
    }

    ///here customer process
     public function customer_index()
    {
        $customers= DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select(
            'users.name as u_name',
            'users.id as u_id',
        )
        ->distinct()
        ->paginate(10);
        return view('admin.customer.show',compact('customers'));
    }
    //
    public static  function userOrders($id)
    {
        $customers= DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->where('users.id',$id)
        ->get();
        $customersCount = $customers->count();
        return $customersCount;
    }
    public function customer_info($id)
    {
        $customer = DB::table('users')
        ->select('users.*')
        ->where('users.id',$id)
        ->get();
        return view('admin.customer.display',compact('customer'));
    }
    public static function orders_Name($id)
    {

        $customer= DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->where('users.id',$id)
        ->select('products.name')
        ->get();
            return $customer;
    }
}

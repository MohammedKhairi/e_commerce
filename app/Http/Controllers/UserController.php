<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Category;
use App\Models\Card;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Comment;


class UserController extends Controller
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
        //
    }
    public function favorite()
    {
        if (Auth::user()){
            $id = Auth::user()->id;
            $favorite = DB::table('favoretes')
            ->join('users', 'favoretes.user_id', '=', 'users.id')
            ->join('products', 'favoretes.product_id', '=', 'products.id')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->where('users.id',$id)
            ->select(
                'favoretes.id as f_id',
                'products.id as p_id',
                'products.name as p_name',
                'products.price as p_price',
                'categories.c_name as c_name')
            ->get();
            // return response()->json([
            //     'status'=>200,
            //     'favorite'=>$favorite
            // ]);
            return $favorite;
        }

        else{
            return redirect()->route('home') ;
        }


    }
    public function add_favorite(Request $request,$p_id)
    {
        if (Auth::user()){
            $u_id = Auth::user()->id;
            if ( $request->isMethod('POST')) {       
                if (Favorite::where('user_id', $u_id )->where('product_id',$p_id)->exists()) 
                {
                return redirect()->back()
                ->with('success',"المنتج موجود مسبقا في قائمة المفضلات");
                }
                else {
                    $favorite=new Favorite;
                    $favorite->user_id=$u_id;
                    $favorite->product_id=$p_id;
                    $favorite->save();
                return redirect()->back()
                ->with('success',"تم أضافة المنتج الى قائمة المفضلات");
                }
            }
            else {
                return redirect()->route('home') ;
            }
        }

        else{
            return redirect()->route('home') ;
        }


    }
    public function destroy_favorite(Request $request,$id)
    {

        $delete = Favorite::find($id);
        if ($delete) {
            $delete->delete();
        return redirect()->route('home')
        ->with('success',"تم حذف العنصر من القائمة بنجاح");
        } else {
            return redirect()->back();
        }
    }
    public function show_card()
    {
        if (Auth::user()){
            $id = Auth::user()->id;
            $card = DB::table('cards')
            ->join('users', 'cards.user_id', '=', 'users.id')
            ->join('products', 'cards.product_id', '=', 'products.id')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->where('users.id',$id)
            ->where('cards.state',0)
            ->select(
                'cards.id as card_id',
                'products.id as p_id',
                'products.name as p_name',
                'cards.product_number as c_number',
                'products.price as p_price',
                'categories.c_name as c_name')
            ->get();
            $categories=Category::all();
            return view('user.card',
            compact('card'),
            compact('categories'),
            
            );
        }

        else{
            return redirect()->route('home') ;
        }


    }
    public function add_card(Request $request,$p_id)
    {
        if (Auth::user()){
            $u_id = Auth::user()->id;
            if ( $request->isMethod('POST')) {       
                if (Card::where('user_id', $u_id )->where('product_id',$p_id)->exists()) 
                {
                return redirect()->back()
                ->with('success',"المنتج موجود مسبقا في قائمة المفضلات");
                }
                else {
                    if (Product::where('id',$p_id)->exists()) 
                    {
                        $product = Product::find($p_id);
                        if($product->num_pice > 0)
                        {   
                            $card=new Card;
                            $card->user_id=$u_id;
                            $card->product_id=$p_id;
                            if($request->has('number_p'))
                            {
                                $request->validate([
                                    'number_p'=>'required',
                                    ]);
                                $card->product_number=$request->input('number_p');
                            }
                            elseif ($request->data) 
                            {
                                return redirect()->back();
                            }
                            else
                            {   
                                $card->product_number=1;
                            }
                            $card->save();
                            return redirect()->back()
                            ->with('success',"لقد تم أضافة المنتج الى بطاقة التسوق");
                        }
                        
                    }

                }
            }
            else {
                return redirect()->route('home') ;
            }
        }

        else{
            return redirect()->route('home') ;
        }
    }
    public function destroy_card(Request $request,$id)
    {

        $delete = Card::find($id);
        if ($delete) {
            $delete->delete();
        return redirect()->route('user.card')
        ->with('success',"تم حذف العنصر من القائمة بنجاح");
        } else {
            return redirect()->back();
        }
    }
    public function order_card(Request $request,$p_id)
    {
        if (Auth::user())
        {
            $u_id = Auth::user()->id;
            if ( $request->isMethod('POST')) 
            {       
                if (!Product::where('id',$p_id)->exists()) 
                {
                return redirect()->back()
                ->with('success',"المنتج غير موجود");
                }
                else 
                {
                    $product=Product::find($p_id);
                    $number_p=$request->input('number_p');
                    if ($number_p>$product->num_pice||$number_p<=0) {
                        return redirect()->back()
                        ->with('success',"عدد القطع التي طلبتها غير متوفرة انتبه الى عدد القطع المتوفرة في المتجر");    
                    } else {
                    $order=new Order;
                    $order->user_id=$u_id;
                    $order->product_id=$p_id;
                    $order->number_p=$number_p;
                    $order->all_price=$product->price*$number_p;
                    $order->save();
                    return redirect()->back()
                    ->with('success',"تم أضافة المنتج الى قائمة الطلابات سوف تجد جميع الطلبات في حسلبك الخاص");   
                    } 
       
                }
            }
            else
            {
                return redirect()->route('home') ;
            }
        }

        else
        {
            return redirect()->route('home') ;
        }


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_order()
    {
        if (Auth::user()){
            $id = Auth::user()->id;
            $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('users.id',$id)
            ->select('orders.*', 'products.name as p_name','users.name as u_name')
            ->where('orders.state',"0")
            ->get();
            $categories=Category::all();
            return view('user.order',
            compact('orders'),
            compact('categories'),
            
            );
        }

        else{
            return redirect()->route('home') ;
        }


    }
    public function destroy_order($id)
    {
        if (Auth::user())
        {
            $u_id = Auth::user()->id;
            $delete = Order::find($id);
            if ($delete) {
                $delete->delete();
            return redirect()->route('user.order')
            ->with('success',"تم حذف الطلب من القائمة بنجاح");
            } else {
                return redirect()->back();
            }
        }
        else {
            return redirect()->back();
        }

    }
    public function add_comment(Request $request,$id)
    {
        if (Auth::user()){
            $name = Auth::user()->name;
            if ( $request->isMethod('POST')) {       
                if(Product::where('id',$id)->exists())
                {
                    $request->validate([
                        'comment'=>'required',
                        ]);
                    $content = $request->input('comment');
                    $comment=new Comment;
                    $comment->product_id=$id;
                    $comment->name=$name;
                    $comment->content=$content;
                    $comment->save();
                    return redirect()->back()
                    ->with('success',"لقد تم أضافة التعليق بنجاح");
            
                }
            }
        }
        return redirect()->back();

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
    public function show()
    {
        if (Auth::user())
        {
            $id = Auth::user()->id;
            $user = User::where('state',0)->find($id);
            $categories=Category::all();

            return view('user.profile',
            compact('user'),
            compact('categories'),
        );
        }
        else {
            return redirect()->back();
        }
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Auth::user())
        {
            $request->validate([
                'name'=>'required',
                'email'=>'required',
               // 'password'=>'required',
                'phone'=>'required',
                'adress'=>'required',
                ]);
            $data = $request->all();
            User::where('state',0)->find(Auth::user()->id)->update($data);
            return redirect()->route('user.profile')
            ->with('success',"تم تحديث المعلومات بنجاح");
       
        }
        else {
            return redirect()->back();
        }
        
    }


}

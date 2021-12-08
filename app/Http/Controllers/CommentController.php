<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Replay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
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
        $commentes = DB::table('comments')
            ->join('products', 'comments.product_id', '=', 'products.id')
            ->select('comments.*', 'products.name as p_name')
            ->where('comments.state',"0")
            ->paginate(10);
        return view('admin.comment.show',compact('commentes'));
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
        $comment = DB::table('comments')
        ->join('products', 'comments.product_id', '=', 'products.id')
        ->select('comments.*', 'products.name as p_name')
        ->where('comments.state',"0")
        ->where('comments.id',$id)
        ->get();
    return view('admin.comment.display',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }
    public function replay(Request $request,$id)
    {
        $request->validate([
            'c_replay'=>'required',
            ]);
        $replay=Replay::create(array_merge($request->all(), ['comment_id' => $id]));
        DB::table('comments')
            ->where('id', $id)
            ->update(['state' => 1]);
            
        return redirect()->route('admin.comment.show')
        ->with('success',"تم الرد على التعليق بنجاح");
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
        $delete = Comment::find($id);
        $delete->delete();
        return redirect()->route('admin.comment.show')
        ->with('success',"تم حذف التعليق بنجاح");
    }
}

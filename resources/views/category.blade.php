@extends('templat.layout')

@section('content')
<p class="text-right font-defult font-bstyle">
    {{__('Posts')}}\{{__('Category')}}\

    @foreach ($cate_name as $item)
    <span class="font-defult font-bstyle text-danger ">
        {{$item->c_name}} 
    </span>
    @endforeach
    </p>

<div class="row">
   <!-- on card -->
   @foreach ($products as $item)
   <div class="col-md-3">
        <div class="card mt-3">
            <div class="product-1 align-items-center p-2 text-center">
                <img src="{{ asset('image/hp.jpeg') }}" alt="" srcset=""  class="rounded" width="160px">
                <h5>{{$item->c_name}}</h5>
                <!-- card info -->
                <div class="mt-3 info">
                    <span class="text1 d-block">
                        {{$item->name}}
                    </span>
                    <span class="text1 ">
                        {{Str::limit($item->detail, 100)}}
                    </span>
                </div>

                <div class="cost mt-3 text-dark">
                    <span>{{$item->price}} IQD</span>
                    <div class="star mt-3 align-items-center">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    </div>
                </div>
            </div>
            <!-- button for card -->
            <div class="p-3 shoe text-center text-white mt-3 cursor">
                <div class="row">
                    <div class="col-sm">
                        <form action="{{route('user.card.add',$item->id)}}" method="post">
                            @csrf 
                            @method('POST')
                            <button type="submit" class="btn">
                                <p class="text-white font-defult tooltipp">{{__('cadd')}}</p>
                                <i class="fa fa-shopping-cart text-white" style="font-size:30px;curser:pointer; "></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-sm">
                        <form action="{{route('product.show',$item->id)}}" method="post">
                            @csrf 
                            @method("get")
                            <button type="submit" class="btn" >
                                <p class="text-white font-defult tooltipp">{{__('pshow')}}</p>
                                <i class="fa fa-eye text-white" style="font-size:30px;curser:pointer; "></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-sm">
                        <form action="{{route('user.favorite.add',$item->id)}}" method="post">
                            @csrf 
                            @method("POST")
                            <button type="submit" class="btn">
                                <p class="text-white font-defult tooltipp">{{__('fadd')}}</p>
                                <i class="fa fa-heart text-white" style="font-size:30px;curser:pointer; "></i>
                            </button>
                        </form>
                    </div>

                </div>
                
                

                
            </div>
        </div>
    </div>
   @endforeach
</div>
<br>
<div class="text-center font-defult h5" style="display: flex;justify-content: center;">
    {{$products->links('pagination::bootstrap-4')}}

</div>
   <script src="{{asset('js/jquery.js')}}"></script>
    <script>
        jQuery(".btn").hover(
            function() {
                jQuery(this).find(".tooltipp").css("display","block");
                jQuery(this).find(".tooltipp").css("top","-40px");
            },
            function() {
                jQuery(this).find(".tooltipp").css("display","none");
            }
            );
    </script>
@endsection

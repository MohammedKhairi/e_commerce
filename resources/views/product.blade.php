@extends('templat.layout')

@section('content')
@php
    $product_id=0;
@endphp
@foreach ($product as $item)
<div class="row">
    <div class="col-md-7 p-3">
        <div class="row">
            <div class="col-md-5">
                <h3 class="font-defult">{{__('Discrption')}}</h3>
                <p class="font-defult">{{$item->detail}}</p>

            </div>
            <div class="col-md-7">
                <div class="newarrivel tetx-center font-defult">
                    {{$item->c_name}}
                </div>
                <h2>{{$item->name}}</h2>
                <div class="cost mt-3 text-dark font-defult">
                    <span class="font-defult">{{$item->price." "."IQD"}} </span>
                    <div class="star mt-3 align-items-center">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <br>
                <div class="row" style="direction:ltr; ">
                    
                    <div class="col-md-5">
                        <form action="{{route('user.card.add',$item->id)}}" method="POST">
                            @csrf
                            @method("POST")
                        <div class="row">
                            <div class="col">
                                <label for="Number Pices">{{__('Number Pices')}}</label>
                            </div>
                            <div class="col">
                                <input type="number" name="number_p" id="typeNumber" value="1" class="form-control mb-2"/>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <button type="submit" class="btn btn-success">
                            <i style="font-size:1.2em;" class="fa fa-shopping-cart"></i>
                            <span class="font-defult">
                                {{__('cadd')}}
                            </span>
                        </button>
                    </div>
                    </form>
                </div>
                <h5 class="mt-5 font-defult">{{__('Avlible pices of Product:')}} 
                    <span class="rounded-circle bg-success text-white pl-2 pr-2">{{$item->num_pice}}</span>
                </h5>
            </div>
        </div>
        
    </div>
    <div class="col-md-5">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('image/hp.jpeg') }}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('image/hp.jpeg') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('image/hp.jpeg') }}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <div class="bg-success p-2 rounded-circle">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </div>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <div class="bg-success p-2 rounded-circle">
                    <span class="carousel-control-next-icon " aria-hidden="true"></span>
                    <span class="sr-only ">Next</span>
                </div>
            </a>
        </div>
    </div>
</div>
@php
    $product_id=$item->id;
@endphp

{{--Related post --}}
<hr>
<p class="text-right font-defult font-bstyle"> {{__('Products')}} {{__('Related')}} </p>

<div class="container">
    <div id="related_product_all" data-text={{$item->name}}>

    </div>
<script src="{{ asset('js/app.js') }}" defer></script>
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
 </div>
 {{-- comment --}}
 <hr>
<div class="container">
    <p class="text-right font-defult font-bstyle">{{__('Leave')}} {{__('Comment')}}</p>
    <div class="row">
        <div class="col-md-8">
            <form action="{{route('user.comment.add',$product_id)}}" method="POST">
                @csrf
                @method("POST")
                <label for="form-control" class="font-defult tetx-right float-right">{{__('Write')}} {{__('Comment')}}</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
                @error('comment')
                <div style="color:red;">{{ $message }}</div>
                @enderror
                <button class="btn btn-success font-defult float-right mt-3" type="submit">{{__('Add')}} {{__('Comment')}}</button></td>
            </form>
        </div>
    </div>

<br>
<hr>
<p class="text-right font-defult font-bstyle">{{__('Comments')}} <i class="fa fa-comment" style = "color: rgb(8, 97, 170);" ></i> </p>
    <div id="comment_show_all" data-text={{$item->id}}>
         
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <div class="row text-right mt-3">
        <div class="col-md-1">
                <i class="fa fa-user" 
                   style="font-size: 40px;color:rgb(255, 255, 255);background-color: rgb(8, 97, 170);padding:0.8rem;border-radius:50%;">
                </i>
        </div>
        <div class="col-md-9">
            <div class="col">
                <h5 class="font-defult"><span class="m-2 font-defult" >May 15,2021</span> Mohammed </h5>
            </div>
            <div class="col">
                <p class="direction-defult font-defult">
                    this is good and very good laptop this is good and very good laptop
                    this is good and very good laptop this is good and very good laptop
                    this is good and very good laptop this is good and very good laptop
                    this is good and very good laptop this is good and very good laptop
                </p> 
            </div>
            <div class="col">
                <p class="bg-dark text-white font-defult p-2 text-right rounded">
                    <span class="fa fa-reply text-info m-2 ">
                        <span class="text-danger font-defult text-right ">Admin</span>
                    </span>
                    this is good and very good laptop this is good and very good laptop
                    this is good and very good laptop this is good and very good laptop
                    this is good and very good laptop this is good and very good laptop
                    this is good and very good laptop this is good and very good laptop
                </p>
            </div>
        </div>
    </div> --}}
</div>
@endforeach
@endsection

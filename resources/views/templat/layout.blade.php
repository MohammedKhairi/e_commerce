<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-Commerce</title>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ url('/css/style.css') }}">
        <!-- Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            body {
                @font-face {
                    font-family: Cairo;
                    src: url('{{ public_path('fonts/Cairo-Light.tff') }}');
                }
            }
        </style>
    </head>
  <body>
      <div class="container-fluid"> 
          <Header>
            <nav class="navbar">  
                <div class="row" style="width: 100%;">

                    <div class="col-md-5">
                        <div class="grid-container">
                            <div class="grid-item">
                                <a class="text-dark text-decoration-none cart__text"  href="http://127.0.0.1:8000/User/Card">
                                    {{__('Cart')}}
                                    <i style="font-size:1.2em;color:red;" class="fa fa-shopping-cart"></i></a>
                            </div>
                            <div class="grid-item">
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        
                                    <i style="font-size:1.2em;color:red;" class="fa fa-heart"></i>
                                    
                                    {{__('Favorite')}}
                                                
                                    </button>
                                        <div class="dropdown-menu display-flex">
                                            @auth
                                            <?php
                                                $favorite=app('App\Http\Controllers\UserController')->favorite(); 
                                            ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">{{__('pname')}}</th>
                                                    <th scope="col">{{__('Category')}}</th>
                                                    <th scope="col">{{__('Price')}}</th>
                                                    <th scope="col">{{__('Operation')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($favorite as $item)
                                                    <tr >
                                                        <td>{{$item->p_name}}</td>
                                                        <td>{{$item->c_name}}</td>
                                                        <td>{{$item->p_price}}</td>
                                                        <td>
                                                            <form action="{{route('user.favorite.destroy',$item->f_id)}}" method="post">
                                                                @csrf 
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    Delete
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endauth
                                            @guest
                                                <a class="dropdown-item" href="{{ route('login') }}">
                                                    {{__('Login')}}
                                                    <i class="fa fa-sign-out" aria-hidden="true" style="color:red;"></i>
                                                </a>        
                                            @endguest
                                        </div>
                                </div>
                            </div>
                            {{-- <div class="grid-item">
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle font-defult" data-toggle="dropdown">
                                    <a >Language</a>
                                    <i style="font-size:1.2em;" class="fa fa-globe"></i>
                                    </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ url('change-language/ar') }}">{{__('arabic')}}</a>
                                            <a class="dropdown-item" href="{{ url('change-language/en') }}">{{__('english')}}</a>
                                        </div>
                                </div>
                            </div> --}}
                            <div class="grid-item">
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        {{__('Account')}}
                                    <i style="font-size:1.2em;color:red;" class="fa fa-user"></i>
                                    </button>
                                        
                    
                                @guest
                                <div class="dropdown-menu" style="width: 7rem;"> 
                                @if (Route::has('login'))
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        {{__('Login')}}
                                        <i class="fa fa-sign-in" aria-hidden="true" style="color:red;"></i>
                                    </a>
                                @endif

                                @if (Route::has('register'))
                                        <a class="dropdown-item" href="{{ route('register') }}">
                                            {{__('Register')}}
                                            <i class="fa fa-sign-out" aria-hidden="true" style="color:red;"></i>
                                        </a>
                                @endif
                                </div>
                                
                                @else
                                <div class="dropdown-menu"  style="width: 7rem;">
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">{{ Auth::user()->name }} <span><i class="fa fa-user"></i></span> </a>
                                    <a class="dropdown-item" href="{{ route('user.order') }}">{{ __('Orders') }} <span><i class="fa fa-first-order"></i></span> </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        
                                        {{ __('logout') }}
                                        <i class="fa fa-sign-out" aria-hidden="true" style="color:red;"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @endguest
                                 </div>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-3">
                            <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control text-right" id="search_input" name="search" placeholder=" {{__('insertsearch')}}" aria-describedby="addon-wrapping">

                            </div>
                            <div id="search" class="table-responsive-lg">
                            </div>
                            <script src="{{ asset('js/app.js') }}" defer></script>

                        </div>
                     </div>
                    <div class="col-md-2">
                        <div class="mt-3">

                             <img src="{{ asset('image/logo.png') }}" class="rounded" alt="Cinque Terre"  height="50px">
                         </div>
                   
                    </div>  
                </div>
            </nav>

            <nav class="menu_nav">						
                <ul>
                    <li>
                        <a class="font-defult @if(\Request::is('Home') ) active  @endif @if(\Request::is('/') ) active  @endif" href="{{route('home')}}">
                            Home
                            <i style="font-size:1.2em;" class="fa fa-home"></i>
                        </a>
                    </li>
                    @foreach ($categories as $item)
                    <li>
                        <a class="font-defult {{ (request()->segment(2) == $item->c_name) ? 'active' : '' }}" href="{{route('category.product',$item->c_name)}}">
                            {{$item->c_name}} 
                            <img src="{{ asset('image/'.$item->c_img) }}" width="20px" height="20px" class="list-inline-item" alt="...">
                        </a>
                    </li>
                    @endforeach
                </ul>
                <label id="icon">
                    <i class="fa fa-bars"></i>
                </label>
            </nav>	
            <script>
                $(document).ready(function(){
                    $('#icon').click(function(){
                        $('.menu_nav').toggleClass('show');
                        $('.menu_nav ul').toggleClass('show');
                    });
                });

                
            </script>	

            {{-- <div class="row">
				<div class="col-12">
					<nav class="navbar navbar-expand-md bg-danger direction-defult">						
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto py-4 py-md-0">
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link font-defult color-defult-nav p-2" href="{{route('home',$item->c_name)}}">
                                        Home
                                        <i style="font-size:1.2em;" class="fa fa-home"></i>
                                    </a>
								</li>
                                
                                @foreach ($categories as $item)
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link font-defult color-defult-nav p-2" href="{{route('category.product',$item->c_name)}}">
                                        {{$item->c_name}} 
                                        <img src="{{ asset('image/'.$item->c_img) }}" width="20px" height="20px" class="list-inline-item" alt="...">
                                    </a>
								</li>
                                @endforeach
								
							</ul>
						</div>
						
					</nav>		
				</div>
			</div> --}}
          </Header>
          <br>
          <div class="content">
                <div class="last-item direction-defult">
                     {{-- show massages --}}
                    @if ($message=Session::get('success'))
                        <p class="text-center font-defult p-2 bg-success" style="color: white">{{$message}}
                        </p>
                    @endif
                    
                    <!-- load home page content -->
                         @yield('content') 
                    </div>
                    
                </div>
          </div>
          <br>
          <footer class="bg-dark">
              <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mt-3">
                            <div class="product-1 align-items-center p-2 text-center">
                            <h5 class="text1">{{__('Social media')}}</h5>
                                <hr>
                                <img src="{{ asset('image/logo.png') }}" alt="" srcset=""  class="rounded" width="160px">
                                <div class="mt-3 info">
                                    <span class="text1 d-block">
                                        {{__('wabout')}}
                                    </span>
                                </div>
                                <div class="cost mt-3 text-dark">
                                    <div class="star mt-3 align-items-center">
                                    <i class="fa fa-facebook p-3 rounded-circle" style="size:15px;"></i>
                                    <i class="fa fa-instagram p-3 rounded-circle" style="size:15px;"></i>
                                    <i class="fa fa-youtube p-3 rounded-circle" style="size:15px;"></i>
                                    <i class="fa fa-twitter p-3 rounded-circle" style="size:15px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-3">
                            <div class="product-1 align-items-center p-2 text-center">
                                <h5 class="text1">{{__('Categories')}}</h5>
                                <hr>
                                <div class="cost mt-3 text-dark">
                                    <div class="star mt-3 align-items-center">
                                    <ul class="footer_tag">
                                        @foreach ($categories as $item)
                                        <li><a class="" href="{{route('category.product',$item->c_name)}}">{{$item->c_name}}</a><li>
                                        @endforeach
                                    </ul>                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-3">
                        <div class="product-1 align-items-center p-2 text-center">
                        <h5 class="text1">{{__('u_subscribe')}}</h5>
                                <hr>
                                <div class="mt-3 info">
                                    <span class="text1 d-block">
                                        {{__('subscribe')}}
                                    </span>
                                </div>
                                <div class="cost mt-3 text-dark">
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الأيميل</label>
                                        <input type="email" class="form-control text-right" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="قم بأدخال الأيميل">
                                    </div>

                                    <button type="submit" class="btn btn-primary text1">أشتراك</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="color: red;width: 100%;height: 15px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mt-3">
                            <div class="product-1 align-items-center p-2 text-center">
                                <div class="mt-3 info">
                                <p class="text1">                     
                                    Copyright © 2019 All rights of design are Reserved For Mohaemed Khairi
                                <i class="fa fa-heart-o" aria-hidden="true" style="color:red;"></i>
                                </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-3">
                            <div class="product-1 align-items-center p-2 text-center">
                                <div class="mt-3 info">
                                <ul class="list-inline">
                                    <li class="list-inline-item font-defult p-2 "><a class="text-danger atext" href="{{route('aboutus')}}">{{__('About Us')}}</a></li>
                                    <li class="list-inline-item font-defult p-2 "><a class="text-danger atext" href="{{route('contactus')}}">{{__('Contact')}}</a></li>
                                    <li class="list-inline-item font-defult p-2 "><a class="text-danger atext" href="{{route('privcy')}}">{{__('Privcy')}}</a></li>
                                    <li class="list-inline-item font-defult p-2 "><a class="text-danger atext" href="{{route('home')}}">{{__('Home')}}</a></li>
                                </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                
              </div>
               
          </footer>
      </div>
  </body>
</html>

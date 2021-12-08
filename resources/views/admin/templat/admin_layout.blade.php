<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 ,maximum-scale=1">
        <title>Admin Dashbord</title>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ url('/css/admin_style.css') }}">
        <!-- font awesome icon8 -->
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

        <!-- Bootstrap -->
        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

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
       <input type="checkbox" name="" id="nav-taggle">
       <div class="sidebar">
            <div class="sidebar-brand">
                <h2><span class="lab la-accusoft"> <span>Accusoft</span> </span></h2>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li title="الرئيسية">
                         <a href="http://127.0.0.1:8000/Admin"class="active2 getactive"><span class="las la-igloo">
                        <span>Dashbord</span>
                     </span></a>
                    </li>
                    <li title="الزبائن">
                        <a href="http://127.0.0.1:8000/Admin/Customer/Show" class="getactive"><span class="las la-users">
                        <span>Customers</span>
                        </span></a>
                    </li>
                    <li title="الطلبات">
                        <a href="http://127.0.0.1:8000/Admin/Order/Show" class="getactive"><span class="las la-shopping-bag">
                            <span>Orders</span>
                         </span></a>
                    </li>
                    <li title="المنتجات">
                        <a href="http://127.0.0.1:8000/Admin/Products/Show" class="getactive"><span class="las la-clipboard-list">
                            <span>Products</span>
                        </span></a>
                    </li>
                    <li title="التصنيفات">
                        <a href="http://127.0.0.1:8000/Admin/Category/Show" class="getactive"><span class="las la-list">
                            <span>Category</span>
                        </span></a>
                    </li>                   
                    <li title="التعليقات">
                        <a href="http://127.0.0.1:8000/Admin/Comment/Show" class="getactive"><span class="las la-comment">
                        <span>Comments</span>
                     </span></a>
                    </li>
                    <li title="الحساب">
                        <a href="http://127.0.0.1:8000/Admin/Show" class="getactive"><span class="las la-user-circle">
                            <span>Account</span>
                            </span>
                        </a>
                    </li>
                    <li title="المهام">
                        <a href="http://" class="getactive"><span class="las la-clipboard-list">
                            <span>Tasks</span>
                        </span></a>
                    </li>
                </ul>
            </div>
       </div>

       <div class="main-content">
            <header>
                <h2>
                    <label for="nav-taggle">
                         <span class="las la-bars"></span>
                    </label>
                    Dashboard
                </h2>
                <div class="search-wrapper">
                    <span class="las la-search"></span>
                    <input type="search" name="" id="" placeholder="search here">
                </div>
                <div class="user-wrapper">
                    <img src="{{ asset('image/user.png') }}" alt="" srcset="" width="40px" height="40px">
                    <div>
                        <h4>Mohammed</h4>
                        <small>super admin</small>
                    </div>
                
                </div>
            </header>
            <main>
                 <!-- load home page content -->
                 {{-- {{ AdminController::count_project(); }} --}}
                <?php
                 $content_number=app('App\Http\Controllers\AdminController')->count_project(); 

                 ?>
                 <div class="card">
                    
                    <!-- on card -->
                    <div class="card-single">
                        <div>
                            <h1>{{$content_number[0]}}</h1>
                            <span>المنتجات</span>
                        </div>
                        <div>
                            <span class="las la-clipboard-list"></span>
                        </div>
                    </div>
                    <!-- on card -->
                    <div class="card-single">
                        <div>
                            <h1>1</h1>
                            <span>الزبائن</span>
                        </div>
                        <div>
                            <span class="las la-shopping-bag"></span>
                        </div>
                    </div>
                    <!-- on card -->
                    <div class="card-single">
                        <div>
                            <h1>{{$content_number[1]}}</h1>
                            <span>التعليقات</span>
                        </div>
                        <div>
                            <span class="las la-comment"></span>
                        </div>
                    </div>
                    <!-- on card -->
                    <div class="card-single">
                        <div>
                            <h1>{{$content_number[2]}}</h1>
                            <span>الطلبات</span>
                        </div>
                        <div>
                            <span class="lab la-google-wallet"></span>
                        </div>
                    </div>
             
                </div> 
                 @yield('content') 
            </main>
       
       </div>
       <script type="text/javascript" src="{{ URL::asset('js/navactive.js') }}"></script>
  </body>
</html>

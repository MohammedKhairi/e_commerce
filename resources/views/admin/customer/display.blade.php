@extends('admin/templat.admin_layout')

@section('content')
    {{-- show massages --}}
    @if ($message=Session::get('success'))
        <p class="message">{{$message}}
        </p>
    @endif
    <div class="recent-grid" style="grid-template-columns:100%;">
        <div class="projects">
            <div class="card2">
                <div class="card-header">
                        <a href="{{route('admin.customer.customer_index')}}">رجوع 
                            <span class="las la-arrow-right"></span>
                        </a>
                    
                    <h3>عرض معلومات الزبون</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                            @foreach($customer as $item)
                                <tr>
                                    <td class="show">أسم الزبون</td>
                                    <td>{{$item->name}}</td>
                                </tr>
                                <tr>
                                    <td class="show">عنوان الزبون</td>
                                    <td>{{$item->adress}}</td>
                                </tr>
                                <tr>
                                    <td class="show">الطلبات</td>
                                    <td>
                                        @php
                                           $iteam=\App\Http\Controllers\OrderController::orders_Name($item->id);
                                            foreach ($iteam as $value) {
                                                echo '<i style="
                                                color:#fff;
                                                background:var(--main-color);
                                                border-radius:5px;
                                                margin:2px;
                                                padding:0px 2px;
                                                ">'
                                                  .$value->name.'</i>';
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                                
                            </thead>

                        </table>
                        {{-- {!!$products->links()!!} --}}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
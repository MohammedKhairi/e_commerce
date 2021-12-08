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
                        <a href="{{route('admin.order.show')}}">رجوع 
                            <span class="las la-arrow-right"></span>
                        </a>
                    
                    <h3>عرض معلومات الطلب</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                            @foreach($order as $item)
                                <tr>
                                    <td class="show">أسم المنتج</td>
                                    <td>{{$item->p_name}}</td>
                                </tr>
                                <tr>
                                    <td class="show">سعر المنتج</td>
                                    <td>{{$item->price}}</td>
                                </tr>
                                <tr>
                                    <td class="show">أسم الشخص</td>
                                    <td>{{$item->u_name}}</td>
                                </tr>
                                <tr>
                                    <td class="show">عدد القطع</td>
                                    <td>{{$item->number_p}}</td>
                                </tr>
                                <tr>
                                    <td class="show">السعر الكلي</td>
                                    <td>{{$item->all_price}}</td>
                                </tr>
                                <tr>
                                    <td class="show">تأريخ الطلب</td>
                                    <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
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
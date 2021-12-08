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
                    
                    <h3>أخر الطلبات</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <td>أسم المنتج</td>
                                    <td>اسم الشخص</td>
                                    <td>عدد القطع</td>
                                    <td>السعر الكلي</td>
                                    <td>تأريخ الطلب</td>
                                    <td>الفعاليات</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $item)
                                <tr>
                                    <td>{{$item->p_name}}</td>
                                    <td>{{$item->u_name}}</td>
                                    <td>{{$item->number_p}}</td>
                                    <td>{{$item->all_price}}</td>
                                    <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                                    <td>
                                        <a class="edit" href="{{route('admin.order.display',$item->id)}}">
                                            <span class="la la-pencil"></span>
                                            عرض
                                        </a>
                                        <form class="delete" method="POST" action="{{route('admin.order.destroy',$item->id)}}">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="delete" type="submit">
                                            <span class="la la-trash"></span>
                                                حذف
                                            </button>
                                            
                                        </form>
                                   
                                    </td>
                                </tr>
                            @endforeach
                                
                            </tbody>

                        </table>
                    </div>
                    <div class="page_nation">
                        {!! $orders->links() !!}
                    </div>   
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
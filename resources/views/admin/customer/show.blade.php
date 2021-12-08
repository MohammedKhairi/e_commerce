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
                    <h3>جميع الزبائن</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <td>اسم الشخص</td>
                                    <td>عدد الطلبات</td>
                                    <td>الفعاليات</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $item)
                                <tr>
                                    <td>{{$item->u_name}}</td>
                                    <td>
                                        {{\App\Http\Controllers\OrderController::userOrders($item->u_id);}}
                                    </td>
                                    <td>
                                        <a class="edit" href="{{route('admin.customer.customer_info',$item->u_id)}}">
                                            <span class="la la-pencil"></span>
                                            عرض المعلومات
                                        </a>
                                   
                                    </td>

                                </tr>
                            @endforeach
                                
                            </tbody>

                        </table>
                    </div>
                    <div class="page_nation">
                        {!! $customers->links() !!}
                    </div>   
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
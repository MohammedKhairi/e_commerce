@extends('admin/templat.admin_layout')

@section('content')
   <!-- content-->
    <div class="recent-grid" >
        <div class="projects">
            <div class="card2">
                <div class="card-header">
                    <a href="{{route('admin.product.show')}}">رؤية الكل 
                        <span class="las la-eye"></span>
                    </a>
                    <h3>أخر المنتجات</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <td>أسم المتج</td>
                                    <td>تصنيف المنتج</td>
                                    <td>حالة المنتج</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->c_name}}</td>
                                    <td>
                                        @if($item->num_pice>0)
                                            <span class="status purple"></span>متوفر {{'('.($item->num_pice).')'}}
                                        @else
                                            <span class="status red"></span>غير متوفر{{'('.($item->num_pice).')'}}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="customers">
            <div class="card2">
                    <div class="card-header">
                        <a href="{{route('admin.comment.show')}}">رؤية الكل 
                            <span class="las la-eye"></span>
                        </a>
                        <h3>اّخر التعليقات </h3>

                    </div>
                    <div class="card-body">
                        @foreach($commentes as $item)
                        <div class="customer">
                            <div class="info">

                                <div>
                                    <h4>{{$item->name}}</h4>
                                    <small>{{$item->p_name}}</small>
                                </div>
                                <div class="contact"> 
                                    <span class="las la-comment"></span>
                                    {{Str::limit($item->content, 20)}}</td>
                                </div>
                            </div>
                            
                        </div>    
                        @endforeach

                    </div>
            </div>
        </div>
    </div>
@endsection
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
                        <a href="{{route('admin.product.create')}}">جديد 
                            <span class="las la-plus"></span>
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
                                    <td>سعر المنتج</td>
                                    <td>حالة المنتج</td>
                                    <td>الفعاليات</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->c_name}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>
                                        @if($item->num_pice>0)
                                            <span class="status purple"></span>متوفر {{'('.($item->num_pice).')'}}
                                        @else
                                            <span class="status red"></span>غير متوفر{{'('.($item->num_pice).')'}}
                                        @endif
                                    </td>
                                    <td>
                                        <a class="edit" href="{{route('admin.product.edit',$item->id)}}">
                                            <span class="la la-pencil"></span>
                                            تعديل
                                        </a>
                                        <form class="delete" method="POST" action="{{route('admin.product.destroy',$item->id)}}">
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
                    <br>
                    <div class="page_nation">
                        {!! $products->links() !!}
                    </div>   
                    <br>
                    
                </div>
                
            </div>
            
        </div>
    </div>
    
@endsection
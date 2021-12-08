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
                        <a href="{{route('admin.category.create')}}">جديد 
                            <span class="las la-plus"></span>
                        </a>
                    
                    <h3>أخر المنتجات</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <td>أسم التصنيف</td>
                                    <td>صورة التصنيف</td>
                                    <td>الفعاليات</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($category as $item)
                                <tr>
                                    <td>{{$item->c_name}}</td>
                                    <td>
                                        <img src="{{ asset('image/'.$item->c_img) }}" alt="" srcset=""width="45px" height="40px">
                                        
                                    </td>
                                    <td>
                                        <a class="edit" href="{{route('admin.category.edit',$item->id)}}">
                                            <span class="la la-pencil"></span>
                                            تعديل
                                        </a>
                                        <form class="delete" method="POST" action="{{route('admin.category.destroy',$item->id)}}">
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
                    
                </div>
            </div>
        </div>
    </div>
@endsection
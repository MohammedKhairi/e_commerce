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
                        <a href="{{route('admin.comment.show')}}">رجوع 
                            <span class="las la-arrow-right"></span>
                        </a>
                    
                    <h3>أخر التعليقات</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <td>أسم المنتج</td>
                                    <td>أسم الشخص</td>
                                    <td>التعليق</td>
                                    <td>الفعاليات</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($commentes as $item)
                                <tr>
                                    <td>{{$item->p_name}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{Str::limit($item->content, 20)}}</td>
                                    <td>
                                        <a class="edit" href="{{route('admin.comment.display',$item->id)}}">
                                            <span class="la la-pencil"></span>
                                            رد
                                        </a>
                                        <form class="delete" method="POST" action="{{route('admin.comment.destroy',$item->id)}}">
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
                        {{-- {!!$products->links()!!} --}}
                    </div>
                    <div class="page_nation">
                        {!! $commentes->links() !!}
                    </div>   
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
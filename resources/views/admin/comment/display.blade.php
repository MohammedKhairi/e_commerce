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
                    
                    <h3>الرد على التعليقات</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <thead>
                            @foreach($comment as $item)
                                <tr>
                                    <td class="show">أسم المنتج</td>
                                    <td>{{$item->p_name}}</td>
                                </tr>
                                <tr>
                                    <td class="show">أسم الشخص</td>
                                    <td>{{$item->name}}</td>
                                </tr>
                                <tr>
                                    <td class="show">تأريخ التعليق</td>
                                    <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                                </tr>
                                <tr>
                                    <td class="show">التعليق</td>
                                    <td>{{$item->content}}</td>

                                </tr>
                                <tr>
                                    <td class="show">أكتب رد</td>
                                    <td>
                                        <form action="{{route('admin.comment.replay',$item->id)}}" method="POST">
                                            @csrf
                                            @method("POST")
                                            <textarea name="c_replay" id="" class="btn-all" rows="3">
                                                أكتب رداً
                                            </textarea>
                                        
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2"><button class="btn-submit" type="submit">رد على التعليق</button></td>
                                </tr>
                                        </form>
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
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
                <a href="{{route('admin.product.show')}}">الرجوع 
                    <span class="las la-arrow-right"></span>
                </a>
                <h3>معلومات المدير </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%">
                        <tbody>
                            <form action="
                            {{route('admin.update')}}
                            " method="POST">
                                @csrf
                                @method("POST")
                                <tr>
                                    <td><label for="">الاسم</label></td>
                                    <td>
                                        <input class="btn-all" value="{{$admin->name}}" type="text" name="name" placeholder="قم بأدخال  الاسم">
                                        @error('name')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td><label for="">الايميل</label></td>
                                    <td>
                                        <input class="btn-all" value="{{$admin->email}}" type="email" name="email" placeholder="قم بأدخال الايميل ">
                                        @error('email')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="">الرمز السري</label></td>
                                    <td>
                                        <input class="btn-all" value="{{$admin->email}}" type="password" name="password" placeholder="قم بأدخال الرمز السري ">
                                        @error('password')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="">العنوان</label></td>
                                    <td>
                                        <input class="btn-all" value="{{$admin->adress}}" type="text" name="adress" placeholder="قم بأدخال العنوان ">
                                        @error('adress')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="">رقم الهاتف</label></td>
                                    <td>
                                        <input class="btn-all" value="{{$admin->phone}}" type="number" name="phone" placeholder="قم بأدخال رقم الهاتف ">
                                        @error('phone')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                
                                

                                <tr>
                                    @csrf
                                    @method("POST")
                                    <td colspan="2"><button class="btn-submit" type="submit">تعديل المعلومات</button></td>
                                </tr>
                            </form>
                        </tbody>

                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
<script src="{{ url('/js/select.js') }}"></script>
@endsection


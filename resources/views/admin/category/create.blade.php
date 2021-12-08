@extends('admin/templat.admin_layout')

@section('content') 
<div class="recent-grid" style="grid-template-columns:100%;">
    <div class="projects">
        <div class="card2">
            <div class="card-header">
                <a href="{{route('admin.category.show')}}">الرجوع 
                    <span class="las la-arrow-right"></span>
                </a>
                <h3>أضافة تصنيف جديد</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%">
                        <tbody>
                            <form action="{{route('admin.category.store')}}" method="POST">
                                @csrf
                                @method("POST")
                                <tr>
                                    <td><label for="">أسم التصنيف</label></td>
                                    <td>
                                        <input class="btn-all" type="text" name="c_name" placeholder="قم بأدخال اسم التصنيف">
                                        @error('c_name')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="">أسم الصورة</label></td>
                                    <td>
                                        <input class="btn-all" type="text" name="c_img" placeholder="قم بأختيار أسم صورة التصنيف">
                                        @error('c_img')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><button class="btn-submit" type="submit">أضافة التصنيف</button></td>
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


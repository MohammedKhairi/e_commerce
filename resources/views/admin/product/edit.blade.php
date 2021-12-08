@extends('admin/templat.admin_layout')

@section('content') 
<div class="recent-grid" style="grid-template-columns:100%;">
    <div class="projects">
        <div class="card2">
            <div class="card-header">
                <a href="{{route('admin.product.show')}}">الرجوع 
                    <span class="las la-arrow-right"></span>
                </a>
                <h3>تعديل معلومات المنتج </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%">
                        <tbody>
                            <form action="{{route('admin.product.update',$product->id)}}" method="POST">
                                @csrf
                                @method("POST")
                                <tr>
                                    <td><label for="">أسم المنتج</label></td>
                                    <td>
                                        <input class="btn-all" value="{{$product->name}}" type="text" name="name" placeholder="قم بأدخال اسم المنتج">
                                        @error('name')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="">تصنيف المنتج</label></td>
                                    <td>
                                        <div class="custom-select">
                                            <select name="category">
                                              <option value="{{$category_name->id}}">{{$category_name->c_name}}</option>
                                            @foreach($category as $item)
                                              <option value="{{$item->id}}">{{$item->c_name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="">عدد القطع</label></td>
                                    <td>
                                        <input class="btn-all" value="{{$product->num_pice}}" type="text" name="num_pice" placeholder="قم بأختيار عدد القطع المتوفرة للمنتج">
                                        @error('num_pice')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="">سعر المنتج</label></td>
                                    <td>
                                        <input class="btn-all" value="{{$product->price}}" type="text" name="price" placeholder="قم بأدخال سعر المنتج">
                                        @error('price')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="">تفاصيل المنتج</label></td>
                                    <td>
                                        <textarea name="detail" id="" class="btn-all" cols="30" rows="10">
                                            {!! $product->detail !!}
                                        </textarea>
                                        @error('detail')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    @csrf
                                    @method("POST")
                                    <td colspan="2"><button class="btn-submit" type="submit">تعديل المنتج</button></td>
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


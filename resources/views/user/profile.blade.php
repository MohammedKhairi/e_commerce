@extends('templat.layout')

@section('content')
   <!-- on card -->
   <div class="container">
    <table class="table">
        <tbody>
            <form action="{{route('user.profile.update')}}" method="POST">
                @csrf
                @method("POST")
                <tr>
                    <td><label class="font-defult" for="">{{__('Name')}}</label></td>
                    <td>
                        <input class="form-control text-right" value="{{$user->name}}" type="text" name="name" placeholder="قم بأدخال  الاسم">
                        @error('name')
                        <div style="color:red;">{{ $message }}</div>
                        @enderror
                    </td>
                    
                </tr>
                <tr>
                    <td><label class="font-defult" for="">{{__('E-Mail Address')}}</label></td>
                    <td>
                        <input class="form-control text-right" value="{{$user->email}}" type="email" name="email" placeholder="قم بأدخال الايميل ">
                        @error('email')
                        <div style="color:red;">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                {{-- <tr>
                    <td><label class="font-defult" for="">الرمز السري</label></td>
                    <td>
                        <input class="form-control text-right" value="{{$user->email}}" type="password" name="password" placeholder="قم بأدخال الرمز السري ">
                        @error('password')
                        <div style="color:red;">{{ $message }}</div>
                        @enderror
                    </td>
                </tr> --}}
                <tr>
                    <td><label class="font-defult" for="">{{__('Adress')}}</label></td>
                    <td>
                        <input class="form-control text-right" value="{{$user->adress}}" type="text" name="adress" placeholder="قم بأدخال العنوان ">
                        @error('adress')
                        <div style="color:red;">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label class="font-defult" for="">{{__('Phone')}}</label></td>
                    <td>
                        <input class="form-control text-right" value="{{$user->phone}}" type="number" name="phone" placeholder="قم بأدخال رقم الهاتف ">
                        @error('phone')
                        <div style="color:red;">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    @csrf
                    @method("POST")
                    <td colspan="2" class="text-center"><button class="btn btn-success font-defult text-center" type="submit">{{__('Edit')}} {{__('Information')}}</button></td>
                </tr>
            </form>
        </tbody>

    </table>
      
   </div>
   

@endsection
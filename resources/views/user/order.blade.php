@extends('templat.layout')

@section('content')
   <!-- on card -->
   <div class="container">
      <table class="table">
         <thead class="thead-dark text-center font-defult">
            <th>{{__('pname')}}</th>
            <th>{{__('Name')}}</th>
            <th>{{__('Number Pices')}}</th>
            <th> {{__('Total Price')}}</th>
            <th>{{__('Order Date')}}</th>
            <th>{{__('Operation')}}</th>
         </thead>
         <tbody>

            @foreach ($orders as $item)
            <tr class="text-center font-defult">
               <td>{{$item->p_name}}</td>
               <td>{{$item->u_name}}</td>
               <td>{{$item->number_p}}</td>
               <td>{{$item->all_price}}</td>
               <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
               <td>
                   <form class="delete" method="POST" action="{{route('user.order.destroy',$item->id)}}">
                       @csrf 
                       @method('DELETE')
                       <button class="btn btn-danger font-defult" type="submit">
                        <i class="fa fa-trash"></i>
                        {{__('Delete')}}
                       </button>
                       
                   </form>
               </td>
            </tr>
          
         @endforeach
         </tbody>
      </table>
      
   </div>
   

@endsection
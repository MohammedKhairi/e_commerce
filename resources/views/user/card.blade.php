   @extends('templat.layout')

   @section('content')
      <!-- on card -->
      <div class="container">
         <table class="table">
            <thead class="thead-dark font-defult">
            <tr class="text-center">
               <th scope="col">{{__('pname')}}</th>
               <th scope="col">{{__('Number')}}</th>
               <th scope="col">{{__('Price')}}</th>
               <th scope="col">{{__('Operation')}}</th>
            </tr>
            </thead>
            <tbody>
               @php
                   $price=0;
               @endphp
               @foreach ($card as $item)
               <tr class="text-center">
                  <td>
                     <p class="font-defult"><span class="font-defult">{{__('Name')}}:</span>{{$item->p_name}}</p>
                     <p class="font-defult"><span class="font-defult">{{__('Category')}}:</span>{{$item->c_name}}</p>

                  </td>
                  <td>
                     <form action="{{route('user.card.order',$item->p_id)}}" method="post">
                        @csrf 
                        @method('POST')
                     <input type="number" name="number_p" id="typeNumber" class="form-control w-50 float-none m-auto" value="{{$item->c_number}}"/>
                     
                  </td>
                  <td>{{$item->p_price}}</td>
                  <td>
                     <div class="row text-center" style="display: inline-flex;">
                     <div class="col col-lg-4">     
                        <button type="submit" class="btn btn-success">
                           <span class="font-defult">{{__('Order')}}</span> 
                           <i class="fa fa-first-order"></i>
                        </button>
                     </div>
                     </form>
                        <div class="col col-lg-4 display-inline-block">
                           <form action="{{route('user.card.destroy',$item->card_id)}}" method="post">
                              @csrf 
                              @method('DELETE')
                              <button type="submit font-defult" class="btn btn-danger">
                                 <span class="font-defult">{{__('Delete')}}</span> 

                                 <i class="fa fa-trash-o"></i>
                              </button>
                           </form>
                        </div>
                     </div>
                     
                  </td>
               </tr>
               @php
                  $price=$price+$item->p_price*$item->c_number;
               @endphp
             
            @endforeach
            <thead class="thead-dark font-defult">
               <tr class="text-center">
                  <th scope="col"> {{__('Total Price')}}:</th>
                  <th scope="col">  <span style="margin-right: 16px;">{{$price}}</span><span>IQD</span>   </th>
                  <th scope="col"></th>
                  <th scope="col"></th>
               </tr>
            </thead>
            </tbody>
         </table>
         
      </div>
      

   @endsection
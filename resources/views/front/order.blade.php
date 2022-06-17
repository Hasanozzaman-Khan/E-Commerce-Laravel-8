@extends('front/layout')

@section('page_title', 'Orders')

@section('container')

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
 <div class="aa-catg-head-banner-area">
   <div class="container">

   </div>
 </div>
</section>
<!-- / catg header banner section -->

<!-- Cart view section -->
<section id="cart-view">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
       <div class="cart-view-area">
         <div class="cart-view-table">
           <form action="">

                 <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Order Id</th>
                          <th>Order Status</th>
                          <th>payment Type</th>
                          <th>payment Status</th>
                          <th>payment Id</th>
                          <th>Total Amount</th>
                          <th>placed At</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($orders as $list)

                              <tr>
                                <td>{{$list->id}}</td>
                                <td>{{$list->orders_status}}</td>
                                <td>{{$list->payment_type}}</td>
                                <td>{{$list->payment_status}}</td>
                                <td>{{$list->payment_id}}</td>
                                <td>{{$list->total_amt}}</td>
                                <td>{{$list->added_on}}</td>
                                <td><a href="{{url('order_detail')}}/{{$list->id}}"><button type="button" name="button">View</button></a></td>
                              </tr>

                          @endforeach
                      </tbody>

                    </table>
                  </div>

           </form>
           <!-- Cart Total view -->
           <!-- <div class="cart-view-total">
             <h4>Cart Totals</h4>
             <table class="aa-totals-table">
               <tbody>
                 <tr>
                   <th>Subtotal</th>
                   <td>$450</td>
                 </tr>
                 <tr>
                   <th>Total</th>
                   <td>$450</td>
                 </tr>
               </tbody>
             </table>
             <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
           </div> -->
         </div>
       </div>
     </div>
   </div>
 </div>
</section>
<!-- / Cart view section -->

@endsection

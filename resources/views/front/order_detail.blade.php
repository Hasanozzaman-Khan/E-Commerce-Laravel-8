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
     <div class="col-md-6">
         <div class="order_detail">
             <h3>Delivery Address</h3>
             Name : {{$orders_detail[0]->name}} <br>
             Mobile : {{$orders_detail[0]->mobile}} <br>
             Address : {{$orders_detail[0]->address}} <br>
             City : {{$orders_detail[0]->city}} <br>
             State : {{$orders_detail[0]->state}} <br>
             Zip : {{$orders_detail[0]->pincode}}

         </div>
     </div>
     <div class="col-md-6">
         <div class="order_detail">
             <h3>Order Details</h3>
             Order Status : {{$orders_detail[0]->orders_status}} <br>
             Payment Status : {{$orders_detail[0]->payment_status}} <br>
             Payment Type : {{$orders_detail[0]->payment_type}} <br>

            @if ($orders_detail[0]->payment_id !='')
                Payment Id : {{$orders_detail[0]->payment_id}}
            @endif

         </div>
     </div>
     <div class="col-md-12">
       <div class="cart-view-area">

         <div class="cart-view-table">
           <form action="">

                 <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Image</th>
                          <th>Size</th>
                          <th>Color</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                          @php
                            $totalAmt = 0;
                          @endphp

                          @foreach($orders_detail as $list)
                              @php
                                $totalAmt += $list->price * $list->qty;
                              @endphp
                              <tr>
                                <td>{{$list->pname}}</td>
                                <td><img src="{{asset('storage/media/'.$list->attr_image)}}" alt="{{$list->name}}"></td>
                                <td>{{$list->size}}</td>
                                <td>{{$list->color}}</td>
                                <td>{{$list->price}}</td>
                                <td>{{$list->qty}}</td>
                                <td>{{$list->price * $list->qty}}</td>
                              </tr>
                          @endforeach
                              <tr>
                                  <td colspan="5">&nbsp;</td>
                                  <td>Total :</td>
                                  <td>{{$totalAmt}}</td>
                              </tr>

                        <?php
                            if ($orders_detail[0]->coupon_value > 0) {
                                echo '<tr>
                                    <td colspan="5">&nbsp;</td>
                                    <td>Coupon(<span class="coupon_apply_txt">'.$orders_detail[0]->coupon_code.'</span>) :</td>
                                    <td>'.$orders_detail[0]->coupon_value.'</td>
                                </tr>';
                                $totalAmt = $totalAmt - $orders_detail[0]->coupon_value;
                                echo '<tr>
                                    <td colspan="5">&nbsp;</td>
                                    <td>Grand Total :</td>
                                    <td>'.$totalAmt.'</td>
                                </tr>';
                            }
                        ?>
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

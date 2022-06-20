@extends('admin/layout')

@section('page_title', 'Order Details')

@section('order_select', 'active')

@section('container')




  <h3 class="mb-3">Order - {{$orders_detail[0]->id}}</h3>


  <div class="order_operation">
      Update Order Status
      <select class="form-control m-b-10" id="order_status" onchange="update_order_status({{$orders_detail[0]->id}})">
          <?php
            foreach ($orders_status as $list) {
                if ($orders_detail[0]->order_status == $list->id) {
                    echo "<option value='$list->id' selected>$list->orders_status</option>";
                }else {
                    echo "<option value='$list->id'>$list->orders_status</option>";
                }
            }
           ?>
      </select>


      Update Payment Status
      <select class="form-control m-b-10" id="payment_status" onchange="update_payment_status({{$orders_detail[0]->id}})">
          <?php
            foreach ($payment_status as $list) {
                if ($orders_detail[0]->payment_status == $list) {
                    echo "<option value='$list' selected>$list</option>";
                }else {
                    echo "<option value='$list'>$list</option>";
                }

            }
           ?>
      </select>

      Track Details
      <form  action="{{url('admin/update_track_details')}}/{{$orders_detail[0]->id}}" method="post">
          <textarea class="form-control" name="track_details" rows="3"></textarea>
          <button class="btn btn-success mt-2" type="submit">Update</button>
          <!-- <input class="btn btn-success mt-2" type="submit" name="Update" value="Submit"> -->
          <!-- <input type="hidden" name="id" value="{{$orders_detail[0]->id}}"> -->
          @csrf
      </form>

  </div>


  <div class="row whitebg">
      <!-- START DATA TABLE-->
      <div class="col-md-6 mb-2">
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

             @if ($orders_detail[0]->track_details !='')
                 Track Details : {{$orders_detail[0]->track_details}}
             @endif

          </div>
      </div>
      <div class="col-md-12">
        <div class="cart-view-area">

          <div class="cart-view-table">

                  <div class="table-responsive">
                     <table class="table order_detail">
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

          </div>
        </div>
      </div>
<!-- END DATA TABLE-->
  </div>

@endsection

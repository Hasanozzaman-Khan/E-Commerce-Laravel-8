@extends('admin/layout')

@section('page_title', 'Order')

@section('order_select', 'active')

@section('container')




  <h3 class="my-3">Order</h3>


  <div class="row">
      <!-- START DATA TABLE-->
    <div class="col-md-12">
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Customer Details</th>
                        <th>Order Status</th>
                        <th>payment Type</th>
                        <th>payment Status</th>
                        <th>Total Amount</th>
                        <th>placed At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>
                            {{$list->name}} <br>
                            {{$list->email}} <br>
                            {{$list->mobile}}
                        </td>
                        <td>{{$list->orders_status}}</td>
                        <td>{{$list->payment_type}}</td>
                        <td>{{$list->payment_status}}</td>
                        <td>{{$list->total_amt}}</td>
                        <td>{{$list->added_on}}</td>
                        <td><a href="{{url('admin/order_detail')}}/{{$list->id}}"><button class="btn btn-success" type="button" name="button">View</button></a></td>
                      </tr>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<!-- END DATA TABLE-->
  </div>
@endsection

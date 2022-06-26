@extends('admin/layout')

@section('page_title', 'Product Review')

@section('product_review_select', 'active')

@section('container')

    @if(Session()->has('message'))
      <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
          {{session('message')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endif


  <h3 class="my-3">Product Review</h3>


  <div class="row">
      <!-- START DATA TABLE-->
    <div class="col-md-12">
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product_review as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->pname}}</td>
                        <td>{{$list->rating}}</td>
                        <td>{{$list->review}}</td>
                        <td>{{getCustomDate($list->added_on)}}</td>
                        <td>

                            @if($list->status == 1)
                                <a href="{{url('admin/update_product_review_status/0')}}/{{$list->id}}">
                                    <button class="btn btn-sm btn-warning" type="button" name="button">Deactive</button>
                                </a>
                            @else
                                <a href="{{url('admin/update_product_review_status/1')}}/{{$list->id}}">
                                    <button class="btn btn-sm btn-primary" type="button" name="button">Active</button>
                                </a>
                            @endif
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<!-- END DATA TABLE-->
  </div>
@endsection

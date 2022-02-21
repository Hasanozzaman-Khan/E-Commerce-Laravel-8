@extends('admin/layout')

@section('page_title', 'Manage Coupon')
@section('coupon_select', 'active')

@section('container')
  <div class="row">
  </div>


  <h3>Manage Coupon</h3>
  <a class="my-3" href="{{url('admin/coupon')}}">
      <button class="btn btn-success" type="button" name="button">
          back
      </button>
  </a>


  <div class="row">
      <!-- START DATA TABLE-->
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">

            <div class="card">
                <!-- <div class="card-header">Manage Category</div> -->

                <div class="card-body">

                    <form action="{{route('coupon.manage_coupon_process')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="control-label mb-1">Title</label>
                            <input id="title" value="{{$title}}" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            @error('title')
                                <div class="alert alert-danger" role="alert">
                                  {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="code" class="control-label mb-1">Code</label>
                            <input id="code" value="{{$code}}" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            @error('code')
                                <div class="alert alert-danger" role="alert">
                                  {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="value" class="control-label mb-1">Value</label>
                            <input id="value" value="{{$value}}" name="value" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            @error('value')
                                <div class="alert alert-danger" role="alert">
                                  {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                Submit
                            </button>
                        </div>
                        <input type="hidden" name="id" value="{{$id}}">
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
<!-- END DATA TABLE-->
  </div>
@endsection

@extends('admin/layout')

@section('page_title', 'Manage Tax')
@section('tax_select', 'active')

@section('container')
  <div class="row">
  </div>


  <h3>Manage Tax</h3>
  <a class="my-3" href="{{url('admin/tax')}}">
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

                    <form action="{{route('tax.manage_tax_process')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="tax_value" class="control-label mb-1">Tax Value</label>
                            <input id="tax_value" value="{{$tax_value}}" name="tax_value" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            @error('tax_value')
                                <div class="alert alert-danger" role="alert">
                                  {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tax_desc" class="control-label mb-1">Tax Description</label>
                            <input id="tax_desc" value="{{$tax_desc}}" name="tax_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>

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

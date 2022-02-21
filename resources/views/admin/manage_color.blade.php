@extends('admin/layout')

@section('page_title', 'Manage Color')
@section('color_select', 'active')

@section('container')
  <div class="row">
  </div>


  <h3>Manage Color</h3>
  <a class="my-3" href="{{url('admin/color')}}">
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

                    <form action="{{route('color.manage_color_process')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="color" class="control-label mb-1">Color</label>
                            <input id="color" value="{{$color}}" name="color" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            @error('color')
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

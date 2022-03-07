@extends('admin/layout')

@section('page_title', 'Manage Brand')
@section('brand_select', 'active')

@section('container')
  <div class="row">
  </div>

      @error('image.*')
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror


  <h3>Manage Brand</h3>
  <a class="my-3" href="{{url('admin/brand')}}">
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

                    <form action="{{route('brand.manage_brand_process')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Brand</label>
                            <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                  {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="control-label mb-1">Image</label>
                            <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                            @error('image')
                                <div class="alert alert-danger" role="alert">
                                  {{$message}}
                                </div>
                            @enderror

                            @if($image != '')
                                <a href="{{asset('storage/media/brand/'.$image)}}">
                                    <img width="50px" src="{{asset('storage/media/brand/'.$image)}}" alt="image">
                                </a>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="is_home" class="control-label mb-1">Show in Home Page</label>
                            <input id="is_home" name="is_home" type="checkbox" {{$is_home_selected}}>
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

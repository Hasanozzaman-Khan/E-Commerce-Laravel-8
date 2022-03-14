@extends('admin/layout')

@section('page_title', 'Manage Home Banner')
@section('home_banner_select', 'active')

@section('container')
  <div class="row">
  </div>


  <h3>Manage Home Banner</h3>
  <a class="my-3" href="{{url('admin/home_banner')}}">
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

                    <form action="{{route('home_banner.manage_home_banner_process')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="btn_text" class="control-label mb-1">Text</label>
                                    <input id="btn_text" value="{{$btn_text}}" name="btn_text" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                </div>

                                <div class="col-md-6">
                                    <label for="btn_link" class="control-label mb-1">Link</label>
                                    <input id="btn_link" value="{{$btn_link}}" name="btn_link" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="image" class="control-label mb-1">Banner Image</label>
                            <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false">

                            @if($image != '')
                                <a href="{{asset('storage/media/banner/'.$image)}}" target="_blank"><img width="50px" src="{{asset('storage/media/banner/'.$image)}}" alt="image"></a>

                            @endif

                            @error('image')
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

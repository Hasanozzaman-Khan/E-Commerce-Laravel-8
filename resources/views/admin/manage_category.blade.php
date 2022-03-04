@extends('admin/layout')

@section('page_title', 'Manage Category')
@section('category_select', 'active')

@section('container')
  <div class="row">
  </div>


  <h3>Manage Category</h3>
  <a class="my-3" href="{{url('admin/category')}}">
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

                    <form action="{{route('category.manage_category_process')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="category_name" class="control-label mb-1">Category Name</label>
                                    <input id="category_name" value="{{$category_name}}" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="parent_category_id" class="control-label mb-1">Parent Category</label>
                                    <select id="parent_category_id" class="form-control" name="parent_category_id" aria-required="true" aria-invalid="false" required>
                                        <option value="">Select Parent Category</option>
                                        @foreach($category as $list)
                                            @if($parent_category_id==$list->id)
                                                <option selected value="{{$list->id}}">
                                            @else
                                                <option value="{{$list->id}}">
                                            @endif
                                            {{$list->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                    <input id="category_slug" value="{{$category_slug}}" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    @error('category_slug')
                                        <div class="alert alert-danger" role="alert">
                                          {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="category_image" class="control-label mb-1">Category Image</label>
                            <input id="category_image" name="category_image" type="file" class="form-control" aria-required="true" aria-invalid="false">

                            @if($category_image != '')
                                <a href="{{asset('storage/media/category/'.$category_image)}}" target="_blank"><img width="50px" src="{{asset('storage/media/category/'.$category_image)}}" alt="image"></a>

                            @endif

                            @error('category_image')
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

@extends('admin/layout')

@section('page_title', 'Brand')

@section('brand_select', 'active')

@section('container')

    @if(Session()->has('message'))
      <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
          {{session('message')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endif


  <h3>Brand</h3>
  <a class="my-3" href="{{url('admin/brand/manage_brand')}}">
      <button class="btn btn-success" type="button" name="button">
          Add Brand
      </button>
  </a>


  <div class="row">
      <!-- START DATA TABLE-->
    <div class="col-md-12">
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->name}}</td>
                        <td>
                            @if($list->image != '')
                                <img width="50px" src="{{asset('storage/media/model/'.$list->image)}}" alt="image">
                            @endif
                        </td>
                        <td>
                            <a href="{{url('admin/brand/manage_brand')}}/{{$list->id}}">
                                <button class="btn btn-sm btn-success" type="button" name="button">Edit</button>
                            </a>

                            @if($list->status == 1)
                                <a href="{{url('admin/brand/status/0')}}/{{$list->id}}">
                                    <button class="btn btn-sm btn-warning" type="button" name="button">Deactive</button>
                                </a>
                            @else
                                <a href="{{url('admin/brand/status/1')}}/{{$list->id}}">
                                    <button class="btn btn-sm btn-primary" type="button" name="button">Active</button>
                                </a>
                            @endif

                            <a href="{{url('admin/brand/delete')}}/{{$list->id}}">
                                <button class="btn btn-sm btn-danger" type="button" name="button">Delete</button>
                            </a>

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

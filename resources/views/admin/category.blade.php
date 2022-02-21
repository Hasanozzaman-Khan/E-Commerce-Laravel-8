@extends('admin/layout')

@section('page_title', 'Category')

@section('category_select', 'active')

@section('container')

    <!-- <div class="alert alert-success" role="alert">
      {{session('message')}}
    </div>
  <div class="row">
  </div> -->

    @if(Session()->has('message'))
      <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
          {{session('message')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endif


  <h3>Category</h3>
  <a class="my-3" href="{{url('admin/category/manage_category')}}">
      <button class="btn btn-success" type="button" name="button">
          Add Category
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
                        <th>Category Name</th>
                        <th>Category Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->category_name}}</td>
                        <td>{{$list->category_slug}}</td>
                        <td>
                            <a href="{{url('admin/category/manage_category')}}/{{$list->id}}">
                                <button class="btn btn-sm btn-success" type="button" name="button">Edit</button>
                            </a>

                            @if($list->status == 1)
                                <a href="{{url('admin/category/status/0')}}/{{$list->id}}">
                                    <button class="btn btn-sm btn-warning" type="button" name="button">Deactive</button>
                                </a>
                            @else
                                <a href="{{url('admin/category/status/1')}}/{{$list->id}}">
                                    <button class="btn btn-sm btn-primary" type="button" name="button">Active</button>
                                </a>
                            @endif

                            <a href="{{url('admin/category/delete')}}/{{$list->id}}">
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

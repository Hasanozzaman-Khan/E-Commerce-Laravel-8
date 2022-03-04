@extends('admin/layout')

@section('page_title', 'Manage Product')
@section('product_select', 'active')

@section('container')
  <div class="row">
  </div>

    @if($id>0)
        @php
            $image_required = "";
        @endphp
    @else
        @php
            $image_required = "required";
        @endphp
    @endif

    <h3>Manage Product</h3>
    @if(Session()->has('sku_error'))
      <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
          {{session('sku_error')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endif

    @error('attr_image.*')
      <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
          {{$message}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @enderror

    @error('images.*')
      <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
          {{$message}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @enderror

    <a class="my-3" href="{{url('admin/product')}}">
        <button class="btn btn-success" type="button" name="button">
            back
        </button>
  </a>

  <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
  <div class="row">
      <!-- START DATA TABLE-->
    <div class="col-md-12">
        <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
<!-- Product             -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="control-label mb-1">Name</label>
                                <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('name')
                                    <div class="alert alert-danger" role="alert">
                                      {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Slug</label>
                                <input id="slug" value="{{$slug}}" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('slug')
                                    <div class="alert alert-danger" role="alert">
                                      {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image" class="control-label mb-1">Image</label>
                                <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>
                                @error('image')
                                    <div class="alert alert-danger" role="alert">
                                      {{$message}}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-4">
                                        <label for="category_id" class="control-label mb-1">Category</label>
                                        <select id="category_id" class="form-control" name="category_id" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Category</option>
                                            @foreach($category as $list)
                                                @if($category_id==$list->id)
                                                    <option selected value="{{$list->id}}">
                                                @else
                                                    <option value="{{$list->id}}">
                                                @endif
                                                {{$list->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="brand" class="control-label mb-1">Brand</label>
                                        <select id="brand" class="form-control" name="brand" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $list)
                                                @if($brand==$list->id)
                                                    <option selected value="{{$list->id}}">
                                                @else
                                                    <option value="{{$list->id}}">
                                                @endif
                                                {{$list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="model" class="control-label mb-1">Model</label>
                                        <input id="model" value="{{$model}}" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="short_desc" class="control-label mb-1">Short Description</label>
                                <textarea id="short_desc"  name="short_desc" rows="4" cols="80" class="form-control" aria-required="true" aria-invalid="false" required>{{$short_desc}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="desc" class="control-label mb-1">Description</label>
                                <textarea id="desc"  name="desc" rows="4" cols="80" class="form-control" aria-required="true" aria-invalid="false" required>{{$desc}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="keywords" class="control-label mb-1">Keywords</label>
                                <textarea id="keywords"  name="keywords" rows="3" cols="80" class="form-control" aria-required="true" aria-invalid="false" required>{{$keywords}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="technical_specification" class="control-label mb-1">Technical Specification</label>
                                <textarea id="keywords"  name="technical_specification" rows="3" cols="80" class="form-control" aria-required="true" aria-invalid="false" required>{{$technical_specification}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="uses" class="control-label mb-1">Uses</label>
                                <textarea id="uses"  name="uses" rows="3" cols="80" class="form-control" aria-required="true" aria-invalid="false" required>{{$uses}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="warranty" class="control-label mb-1">Warranty</label>
                                <textarea id="warranty"  name="warranty" rows="3" cols="80" class="form-control" aria-required="true" aria-invalid="false" required>{{$warranty}}</textarea>
                            </div>

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-8">
                                        <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                        <input id="lead_time" value="{{$lead_time}}" name="lead_time" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="tax_id" class="control-label mb-1">Tax</label>
                                        <select id="tax_id" class="form-control" name="tax_id" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Tax</option>
                                            @foreach($taxes as $list)
                                                @if($tax_id==$list->id)
                                                    <option selected value="{{$list->id}}">
                                                @else
                                                    <option value="{{$list->id}}">
                                                @endif
                                                {{$list->tax_desc}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-3">
                                        <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                        <select id="is_promo" class="form-control" name="is_promo" aria-required="true" aria-invalid="false" required>
                                            @if($is_promo=="1")
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                        <select id="is_featured" class="form-control" name="is_featured" aria-required="true" aria-invalid="false" required>
                                            @if($is_featured=="1")
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="is_discounted" class="control-label mb-1">Is Discounted</label>
                                        <select id="is_discounted" class="form-control" name="is_discounted" aria-required="true" aria-invalid="false" required>
                                            @if($is_discounted=="1")
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="is_tranding" class="control-label mb-1">Is Tranding</label>
                                        <select id="is_tranding" class="form-control" name="is_tranding" aria-required="true" aria-invalid="false" required>
                                            @if($is_tranding=="1")
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" name="id" value="{{$id}}">
                        </div>
                    </div>
                </div>



<!-- Product Images            -->
                <h2 class="mb-2">Product Images</h2>
                <div class="col-lg-12" >

                    <div class="card" >
                        <div class="card-body">
                            <div class="form-group">


                                <div class="row" id="product_images_box">
                                    @php
                                        $loop_count_num = 1;

                                    @endphp
                                    @foreach($productImagesArr as $key=>$val)

                                    @php
                                        $loop_count_prev = $loop_count_num;
                                        $pIArr = (array)$val;
                                    @endphp
                                    <input id="piid"  name="piid[]" value="{{$pIArr['id']}}" type="hidden">
                                    <div class="col-md-4 product_images_{{$loop_count_num++}}" >
                                        <label for="images" class="control-label mb-1">Image Attributes</label>
                                        <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false">
                                        @if($pIArr['images'] != '')
                                            <a href="{{asset('storage/media/'.$pIArr['images'])}}" target="_blank"><img width="50px" src="{{asset('storage/media/'.$pIArr['images'])}}" alt="image"></a>

                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        <label for="sku" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label>
                                        @if($loop_count_num ==2)
                                            <button type="button" class="btn btn-success btn-lg mt-4" onclick="add_image_more()"><i class="fa fa-plus"></i>Add</button>
                                        @else
                                            <a href="{{url('admin/product/product_images_delete')}}/{{$pIArr['id']}}/{{$id}}">
                                                <button class="btn btn-lg btn-danger mt-4" type="button" name="button">Delete</button>
                                            </a>
                                            <!-- <button type="button" class="btn btn-danger btn-lg mt-4" ><i class="fa fa-minus"></i> Remove</button> -->
                                        @endif
                                    </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
<!-- Product Attributes            -->
                <h2 class="mb-2">Product Attributes</h2>

                <div class="col-lg-12" id="product_attr_box">
                    @php
                        $loop_count_num = 1;

                    @endphp
                    @foreach($productAttrArr as $key=>$val)

                    @php
                        $loop_count_prev = $loop_count_num;
                        $pAArr = (array)$val;
                    @endphp
                    <input id="paid"  name="paid[]" value="{{$pAArr['id']}}" type="hidden">
                    <div class="card" id ="product_attr_{{$loop_count_num++}}">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-2">
                                        <label for="sku" class="control-label mb-1">SKU</label>
                                        <input id="sku"  name="sku[]" value="{{$pAArr['sku']}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="mrp" class="control-label mb-1">MRP</label>
                                        <input id="mrp"  name="mrp[]" value="{{$pAArr['mrp']}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="price" class="control-label mb-1">Price</label>
                                        <input id="price"  name="price[]" value="{{$pAArr['price']}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="size_id" class="control-label mb-1">Size</label>
                                        <select id="size_id" class="form-control" name="size_id[]" aria-required="true" aria-invalid="false">
                                            <option value="">Select Size</option>
                                            @foreach($sizes as $list)
                                                @if($pAArr['size_id']==$list->id)
                                                    <option value="{{$list->id}}" selected>
                                                        {{$list->size}}
                                                    </option>
                                                @else
                                                    <option value="{{$list->id}}">
                                                        {{$list->size}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="color_id" class="control-label mb-1">Color</label>
                                        <select id="color_id" class="form-control" name="color_id[]" aria-required="true" aria-invalid="false">
                                            <option value="">Select Color</option>
                                            @foreach($colors as $list)
                                                @if($pAArr['color_id']==$list->id)
                                                    <option value="{{$list->id}}" selected>
                                                        {{$list->color}}
                                                    </option>
                                                @else
                                                    <option value="{{$list->id}}">
                                                        {{$list->color}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="qty" class="control-label mb-1">Quantity</label>
                                        <input id="qty"  name="qty[]" type="text"  value="{{$pAArr['qty']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="attr_image" class="control-label mb-1">Image Attributes</label>
                                        <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false">
                                        @if($pAArr['attr_image'] != '')
                                            <img width="50px" src="{{asset('storage/media/'.$pAArr['attr_image'])}}" alt="image">
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <label for="sku" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label>
                                        @if($loop_count_num ==2)
                                            <button type="button" class="btn btn-success btn-lg mt-4" onclick="add_more()"><i class="fa fa-plus"></i>Add</button>
                                        @else
                                            <a href="{{url('admin/product/product_attr_delete')}}/{{$pAArr['id']}}/{{$id}}">
                                                <button class="btn btn-lg btn-danger mt-4" type="button" name="button">Delete</button>
                                            </a>
                                            <!-- <button type="button" class="btn btn-danger btn-lg mt-4" ><i class="fa fa-minus"></i> Remove</button> -->
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                    Submit
                </button>
            </div>
        </form>
    </div>
<!-- END DATA TABLE-->
  </div>

<script>
    var loop_count = 1;
    function add_more(){
        loop_count++;

        var html = '<input id="paid"  name="paid[]" type="hidden"><div class="card" id ="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';

        html += '<div class="col-md-2"><label for="sku" class="control-label mb-1">SKU</label><input id="sku"  name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
        html += '<div class="col-md-2"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp"  name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
        html += '<div class="col-md-2"><label for="price" class="control-label mb-1">Price</label><input id="price"  name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

        var size_id_html = jQuery('#size_id').html();
        size_id_html = size_id_html.replace("selected","");
        html += '<div class="col-md-3"><label for="size_id" class="control-label mb-1">Size</label><select id="size_id" class="form-control" name="size_id[]" aria-required="true" aria-invalid="false">'+size_id_html+'</select></div>';

        // html += '<div class="col-md-3"><label for="size_id" class="control-label mb-1">Size</label><select id="size_id" class="form-control" name="size_id" aria-required="true" aria-invalid="false" required><option value="">Select Size</option>@foreach($sizes as $list)<option value="{{$list->id}}">{{$list->size}}</option>@endforeach</select></div>';
        var color_id_html = jQuery('#color_id').html();
        color_id_html = color_id_html.replace("selected","");
        html += '<div class="col-md-3"><label for="color_id" class="control-label mb-1">Color</label><select id="color_id" class="form-control" name="color_id[]" aria-required="true" aria-invalid="false">'+color_id_html+'</select></div>';
        // html += '<div class="col-md-3"><label for="color_id" class="control-label mb-1">Color</label><select id="color_id" class="form-control" name="color_id" aria-required="true" aria-invalid="false" required><option value="">Select Color</option>@foreach($colors as $list)<option value="{{$list->id}}">{{$list->color}}</option>@endforeach</select></div>';
        html += '<div class="col-md-2"><label for="qty" class="control-label mb-1">Quantity</label><input id="qty"  name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
        html += '<div class="col-md-4"><label for="attr_image" class="control-label mb-1">Image Attributes</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}></div>';
        html += '<div class="col-md-2"><label for="btn_remove" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i> Remove</button></div>';

        html += '</div></div></div></div>';
        jQuery('#product_attr_box').append(html);
    }
    // function remove_more(loop_count){
    //     jQuery('#product_attr_'+loop_count+').remove();
    // }
    function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
    }


    var loop_image_count = 1;
    function add_image_more(){
        loop_image_count++;
        var html = '<input id="piid"  name="piid[]" type="hidden"><div class="col-md-4 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1">Image Attributes</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}></div>';
        html += '<div class="col-md-2 product_images_'+loop_image_count+'"><label for="btn_remove" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i> Remove</button></div>';
        jQuery('#product_images_box').append(html);
    }

    function remove_image_more(loop_image_count){
        jQuery('.product_images_'+loop_image_count).remove();
    }

    CKEDITOR.replace('short_desc');
    CKEDITOR.replace('desc');
    CKEDITOR.replace('technical_specification');
</script>
@endsection

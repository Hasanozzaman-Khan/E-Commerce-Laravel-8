@extends('front/layout')

@section('page_title', 'Search')

@section('container')


<!-- product category -->
<section id="aa-product-category">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-8">
        <div class="aa-product-catg-content">

          <div class="aa-product-catg-body">
            <ul class="aa-product-catg">
              <!-- start single product item -->
              @if(isset($product[0]))
                  @foreach($product as $productArr)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{url('product/'.$productArr->slug)}}"><img src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
                        <a class="aa-add-card-btn"href="javascript:void(0)" onclick="home_add_to_cart('{{$productArr->id}}', '{{$product_attr[$productArr->id][0]->size}}','{{$product_attr[$productArr->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                          <figcaption>
                          <h4 class="aa-product-title"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h4>
                          <span class="aa-product-price">RS {{$product_attr[$productArr->id][0]->price}}</span>
                          <span class="aa-product-price"><del>RS {{$product_attr[$productArr->id][0]->mrp}}</del></span>
                        </figcaption>
                      </figure>
                    </li>
                  @endforeach
              @else
                  <li>
                      <figure>
                          No data found!
                      </figure>
                  </li>
              @endif

            </ul>

          </div>
          <div class="aa-product-catg-pagination">
            <nav>
              <ul class="pagination">
                <li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>


    </div>
  </div>
</section>
<!-- / product category -->


<input type="hidden" id="qty" value="1">
<form id="frmAddToCart">
    @csrf
    <input type="hidden" id="size_id" name="size_id">
    <input type="hidden" id="color_id" name="color_id">
    <input type="hidden" id="pqty" name="pqty">
    <input type="hidden" id="product_id" name="product_id">

</form>



@endsection

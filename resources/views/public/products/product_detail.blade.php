@extends('public.layout.public')

@section('content')
		@php
		$img_not_found     = 'https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg';
    $price_promo       = !empty($product_detail['promo']) ? $product_detail['price'] - $product_detail['promo']['price'] : 0;
    $price_promo_style = 'text-decoration: line-through;';
		@endphp
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('/storage/products/'.$product_detail['image'])}});">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
				        <h6 class="text-white text-uppercase animated slideInDown">Detail Produk</h6>
                <h1 class="text-uppercase display-3 text-white mb-3 animated slideInDown">{{$product_detail['name']}}</h1>
                <h5 class="text-uppercase text-white mb-3 animated slideInDown" style="{{!empty($product_detail['promo']) ? $price_promo_style : ''}}">Rp.{{Helper::helper_number_format($product_detail['price'])}}</h5>
                @if (!empty($product_detail['promo']))
                  <h5 class="text-uppercase text-white mb-3 animated slideInDown">Rp.{{Helper::helper_number_format($price_promo)}}</h5>
                @endif
            </div>
        </div>
    </div>
    <!-- Page Header End -->

	<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
      <div class="owl-carousel testimonial-carousel position-relative">
        	@foreach ($product_detail['images'] as $image)        		
            <div class="testimonial-item text-center">
              <img class="card-img bg-light p-1 mx-auto mb-3" src="{{asset('/storage/products/'.$image['images'])}}">
            </div>
        	@endforeach
      </div>
    </div>
	</div>


  <div class="container-xxl service py-5">
    <div class="container">
      <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
          <div class="col-lg-4">
              <div class="nav w-100 nav-pills me-4">
                  <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                    <h4 class="m-0">Spesifikasi</h4>
                  </button>
                  <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                    <h4 class="m-0">Fitur Spesial</h4>
                  </button>
                  <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                    <h4 class="m-0">Deskripsi</h4>
                  </button>
              </div>
          </div>
          <div class="col-lg-8">
              <div class="tab-content w-100">
                  <div class="tab-pane fade show active" id="tab-pane-1">
                      <div class="row g-4">
                          <div class="col-md-12">
                          	<span>{!! $product_detail['specification'] !!}</span>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tab-pane-2">
                      <div class="row g-4">
                          <div class="col-md-12">
                          	<span>{!! $product_detail['special_feature'] !!}</span>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tab-pane-3">
                      <div class="row g-4">
                          <div class="col-md-12">
                          	<span>{!! $product_detail['description'] !!}</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="mt-5 mb-5">
      	<h1 class="text-uppercase">Mobil Terkait</h1>
			  <div class="row g-4" id="product_car_cat" data-car_cat="{{$product_detail['product_type_id']}}"></div>
      </div>
    </div>
  </div>
@endsection

@section('script')
	<script type="text/javascript">
	    $(document).ready(function(){
	    	let car_cat = $('#product_car_cat').data('car_cat');
	    	car(car_cat)
	      async function car(id)
	      {
		    	await $.ajax({
		    		url: `/product-list/items/${id}`,
		    		type: 'GET',
		    		dataType: 'json',
		    		beforeSend:function(){
		    			$('#product_car_cat').html(`
		    				<center>
		    					<span>Loading...</span>
		    				</center>
		    			`);
		    		},
		    		success:function(res){
		    			$('#product_car_cat').html(res.html);
		    		}
		    	})
	      }
	    })
	</script>
@endsection

@extends('public.layout.public')

@section('content')
		@php
		$img_not_found = 'https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg';
		@endphp
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('/storage/promo/'.$promo_detail['image'])}});">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
				        <h6 class="text-white text-uppercase animated slideInDown">Detail Promo</h6>
                <h1 class="text-uppercase display-3 text-white mb-3 animated slideInDown">{{$promo_detail['name']}}</h1>
                @if (!empty($promo_detail['price']))                
                  <h5 class="text-uppercase text-white mb-3 animated slideInDown">Rp.{{Helper::helper_number_format($promo_detail['price'])}}</h5>
                @endif
            </div>
        </div>
    </div>
    <!-- Page Header End -->
  @if (!empty($promo_detail['images']))  
  	<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container">
        <div class="owl-carousel testimonial-carousel position-relative">
          	@foreach ($promo_detail['images'] as $image)        		
              <div class="testimonial-item text-center">
                <img class="card-img bg-light p-1 mx-auto mb-3" src="{{asset('/storage/promo/'.$image['images'])}}">
              </div>
          	@endforeach
        </div>
      </div>
  	</div>
  @endif

  <div class="container-xxl py-1">
    <div class="container">
        {!!$promo_detail['description']!!}
    </div>
  </div>
  {{-- <div class="container-xxl py-5">
      <div class="container">
          <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
              <h1 class="mb-5 text-uppercase">Daftar Mobil</h1>
          </div>
          <div class="row g-4">
            @if (empty($products))
              <h4 class="text-primary text-uppercase text-center">Daftar Mobil tidak ditemukan</h4>             
            @else
              @php
                $delay = 0.02;
              @endphp
              @foreach ($products as $product)
                @if (!empty($product['promo']) && $product['promo_id'] == $promo_detail['id'])
                  @php
                    $description = substr_replace($product['description'], '...', 20);
                    $delay      += $delay;
                    $price_promo = $product['price'] - $product['promo']['price'];
                  @endphp
                  <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{!!$delay!!}s">
                      <div class="team-item">
                        <div class="position-relative overflow-hidden">
                          <img class="img-fluid" src="{{asset('/storage/products/'.$product['image'])}}" alt="{{$product['name']}}" style="height: 200px;">
                          <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                            <p class="mb-0" style="color: #fff !important;">{!! $description ?? '-'!!}</p>
                          </div>
                        </div>
                        <div class="bg-light text-center p-4">
                          <a href="{{route('public.product_detail', $product['id'])}}"><h5 class="fw-bold mb-0">{{$product['name']}}</h5></a>
                          <p class="mb-2">{{$product['product_type']['name']}}</p>
                          <small style="text-decoration: line-through;">Rp.{{Helper::helper_number_format($product['price'])}}</small>
                          <small>Rp.{{Helper::helper_number_format($price_promo)}}</small>
                        </div>
                      </div>
                  </div>
                @endif
              @endforeach
            @endif
          </div>
      </div>
  </div> --}}



@endsection

{{-- @section('script')
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
@endsection --}}
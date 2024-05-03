@if (empty($products))
	<h4 class="text-primary text-uppercase text-center">Daftar Mobil tidak ditemukan</h4>          		
@else
	@php
		$delay = 0.02;
	@endphp
	@foreach ($products as $product)
		@php
      $description       = substr_replace($product['description'], '...', 20);
      $delay            += $delay;
      $price_promo       = !empty($product['promo']) ? $product['price'] - $product['promo']['price'] : 0;
      $price_promo_style = 'text-decoration: line-through;';
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
            <small style="{{!empty($product['promo']) ? $price_promo_style : ''}}">Rp.{{Helper::helper_number_format($product['price'])}}</small>
            @if (!empty($product['promo']))
              <b><h6>Rp.{{Helper::helper_number_format($price_promo)}}</h6></b>
            @endif
          </div>
        </div>
    </div>
	@endforeach
@endif

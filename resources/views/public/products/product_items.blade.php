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
    {{-- <div class="card card-product-list" style="width: 40%; margin: 0.5rem;">
      <img src="https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div> --}}

    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{!!$delay!!}s">
        <div class="team-item">
          <div class="position-relative overflow-hidden">
            <img class="img-fluid img-custom" src="{{asset('/storage/products/'.$product['image'])}}" alt="{{$product['name']}}">
            <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
              {!! $description ?? '-'!!}
            </div>
          </div>
          <div class="bg-light text-center p-2">
            <a href="{{route('public.product_detail', $product['id'])}}"><h6 class="fw-bold mb-0">{{$product['name']}}</h6></a>
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

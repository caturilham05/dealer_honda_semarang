@extends('public.layout.public')

@section('content')
	@php
	$img_not_found = 'https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg';
	@endphp
  <!-- Page Header Start -->
  <div class="container-fluid page-header mb-5 p-0" style="background-color: grey">
  {{-- <div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('/storage/promo/'.$promos['image'])}});"> --}}
      <div class="container-fluid page-header-inner py-5">
          <div class="container text-center">
              <h1 class="text-uppercase display-3 text-white mb-3 animated slideInDown">{{$promos['name']}}</h1>
              @if (!empty($promos['price']))                
                <h5 class="text-uppercase text-white mb-3 animated slideInDown">Rp.{{Helper::helper_number_format($promos['price'])}}</h5>
              @endif
          </div>
      </div>
  </div>
  <!-- Page Header End -->
  @if (!empty($promos['images']))  
  	<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container">
        <div class="owl-carousel testimonial-carousel position-relative">
          	@foreach ($promos['images'] as $image)        		
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
        {!!$promos['description']!!}
    </div>
  </div>
@endsection
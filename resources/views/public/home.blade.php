@extends('public.layout.public')

@section('content')
  <div class="container-fluid p-0 mb-5">
      <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
      			@php
      				$active = 1;
      			@endphp
          	@foreach ($imageslider as $images)
          		@foreach ($images['images'] as $item)
		            <div class="carousel-item {{($active == 1) ? 'active' : ''}}">
		                <img class="w-100" src="{{asset('/storage/images/imageslider/'.$item['images'])}}" alt="Image">
		            </div>
		            @php
		            	$active++;
		            @endphp
          		@endforeach
          	@endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
      </div>
  </div>

	<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
	    <div class="container">
	        <div class="owl-carousel testimonial-carousel position-relative">
	        		@if (!empty($products))
	        			@foreach ($products as $product)
	        				@php
							      $description = substr_replace($product['description'], '...', 20);
	        				@endphp
			            <div class="testimonial-item text-center">
			                <img class="card-img bg-light p-2 mx-auto mb-3" src="{{asset('/storage/products/'.$product['image'])}}">
	                    <h5 class="mb-0"><a href="">{{$product['name']}}</a></h5>
	                    <p>Rp.{{Helper::helper_number_format($product['price'])}}</p>
	                    <div class="testimonial-text bg-light text-center p-4">
		                    <p class="mb-0">{{$description ?? '-'}}</p>
	                    </div>
			            </div>
	        			@endforeach
	        		@endif
	        </div>
      		<div class="text-center mt-5">
		        <a href="{{route('public.product_list')}}" class="btn btn-primary py-3 px-5">Lihat Semua Mobil<i class="fa fa-arrow-right ms-3"></i></a>
      		</div>
	    </div>
	</div>

  <div class="container-xxl service py-5">
      <div class="container">
      	@foreach ($datas as $item)
      			@if ($item['content_type_id'] == 1)
		          <div class="text-center wow fadeInUp clearfix" data-wow-delay="0.1s" style="margin-top: 2.5rem;">
		              <h6 class="text-primary text-uppercase">{!!$item['intro']!!}</h6>
		              <h1 class="mb-3">{!!$item['title']!!}</h1>
		          </div>
		          <div class="row g-5">
		          	<div class="col-lg-12 pt-2">
		          		{!! $item['content'] !!}
		          	</div>
		          </div>
      			@endif
      	@endforeach
      </div>
  </div>

  <div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container">
          <div class="row gx-5">
              <div class="col-lg-6 py-5">
                  <div class="py-5">
                      <h1 class="text-white mb-4">Hubungi Kami</h1>
                      <div style="display: flex; align-items: center; margin-bottom: 1rem; letter-spacing: 2px;">
												<img style="width: 7%; margin-right: 0.5rem; " src="{{asset('template/logo/wa.png')}}" alt="wa">
	                      <h4 class="text-white mb-0">{{$contact['whatsapp_number']}}</h4>
                      </div>
                      <h5 class="text-white mb-2">{!!$contact['address']!!}</h5>
                      <p class="text-white mb-0">{!!$contact['description']!!}</p>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
										<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d16548.431254934538!2d110.84071544267435!3d-6.80539907023976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sid!2sid!4v1714585406703!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
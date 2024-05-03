@extends('public.layout.public')

@section('content')
  <div class="container-xxl py-5">
      <div class="container">
          <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
              <h6 class="text-primary text-uppercase">Katalog</h6>
              <h1 class="mb-5 text-uppercase">{{$title}}</h1>
          </div>
          <div class="row g-4" id="promo_list">
						@if (empty($promos))
							<h4 class="text-primary text-uppercase text-center">Daftar Mobil tidak ditemukan</h4>          		
						@else
							@php
								$delay = 0.02;
							@endphp
							@foreach ($promos as $promo)
								@php
						      $description = substr_replace($promo['description'], '...', 20);
						      $delay += $delay;
								@endphp
						    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{!!$delay!!}s">
						        <div class="team-item">
						          <div class="position-relative overflow-hidden">
						            <img class="img-fluid" src="{{asset('/storage/promo/'.$promo['image'])}}" alt="{{$promo['name']}}" style="height: 200px;">
						            <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
						              <p class="mb-0" style="color: #fff !important;">{!! $description ?? '-'!!}</p>
						            </div>
						          </div>
						          <div class="bg-light text-center p-4 text-uppercase">
						            <a href="{{route('public.promo_detail', $promo['id'])}}"><h5 class="fw-bold mb-0">{{$promo['name']}}</h5></a>
						            <small>Rp.{{Helper::helper_number_format($promo['price'])}}</small>
						          </div>
						        </div>
						    </div>
							@endforeach
						@endif
          </div>
      </div>
  </div>
@endsection

{{-- @section('script')
	<script type="text/javascript">
	    $(document).ready(function(){
	    	$.ajax({
	    		url: `/promo/items`,
	    		type: 'GET',
	    		dataType: 'json',
	    		beforeSend:function(){
	    			$('#product_list').html(`
	    				<center>
	    					<span>Loading...</span>
	    				</center>
	    			`);
	    		},
	    		success:function(res){
	    			$('#product_list').html(res.html);
	    		}
	    	})
	    })
	</script>
@endsection --}}
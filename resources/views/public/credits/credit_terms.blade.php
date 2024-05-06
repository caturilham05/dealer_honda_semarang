@extends('public.layout.public')

@section('content')
  <div class="container-xxl py-5">
      <div class="container">
          <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
              <h6 class="text-primary text-uppercase">Katalog</h6>
              <h1 class="mb-5 text-uppercase">{{$title}}</h1>
          </div>
          @if (!empty($credits['image']))          
            <div style="display: flex; justify-content: center; align-items: center;">
  	          <img src="{{asset('/storage/credit_terms/'.$credits['image'])}}" style="background-size: cover; background-repeat: no-repeat; background-position: center center;  width: 70%;">
            </div>
          @endif
          <div class="mt-5">
	          {!!$credits['description']!!}
          </div>
      </div>
  </div>
@endsection
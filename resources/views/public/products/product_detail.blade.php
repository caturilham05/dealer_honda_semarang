@extends('public.layout.public')

@section('content')
	@php
  // dd($product_detail);
	$img_not_found     = 'https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg';
  $price_promo       = !empty($product_detail['promo']) ? $product_detail['price'] - $product_detail['promo']['price'] : 0;
  $price_promo_style = 'text-decoration: line-through;';
	@endphp
  <!-- Page Header Start -->
  <div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('/storage/products/'.$product_detail['image'])}});">
      <div class="container-fluid page-header-inner py-5">
          <div class="container text-center">
			        <h6 class="text-white text-uppercase animated slideInDown">Detail Mobil</h6>
              <h1 class="text-uppercase display-3 text-white mb-3 animated slideInDown">{{$product_detail['name']}}</h1>
          </div>
      </div>
  </div>
  <!-- Page Header End -->

  <div class="container-xxl service py-5">
    <div class="container">
      <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s" style="margin-top: -70px">
          <div class="col-lg-4">
              <div class="nav w-100 nav-pills me-4">
                  <button class="nav-link w-100 d-flex align-items-center text-start p-3 active" style="margin-bottom: 1rem" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                    <h4 class="m-0">Harga Mobil</h4>
                  </button>
                  <button class="nav-link w-100 d-flex align-items-center text-start p-3" style="margin-bottom: 1rem" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                    <h4 class="m-0">Brosur</h4>
                  </button>
                  <button class="nav-link w-100 d-flex align-items-center text-start p-3" style="margin-bottom: 1rem" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                    <h4 class="m-0">Spesifikasi</h4>
                  </button>
                  <button class="nav-link w-100 d-flex align-items-center text-start p-3" style="margin-bottom: 1rem" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                    <h4 class="m-0">Cicilan / Kredit</h4>
                  </button>
                  <button class="nav-link w-100 d-flex align-items-center text-start p-3" style="margin-bottom: 1rem" data-bs-toggle="pill" data-bs-target="#tab-pane-5" type="button">
                    <h4 class="m-0">Deskripsi</h4>
                  </button>
              </div>
          </div>
          <div class="col-lg-8">
              <div class="tab-content w-100">
                  <div class="tab-pane fade show active" id="tab-pane-1">
                      <div class="row g-4">
                          <div class="col-md-12">
                            <div class="owl-carousel testimonial-carousel position-relative mb-4 img-detail">
                              @foreach ($products as $item)
                                @if ($product_detail['product_type_id'] == $item['product_type_id'])
                                  <div class="testimonial-item text-center">
                                    <img class="card-img bg-light p-2 mx-auto mb-3" src="{{asset('/storage/products/'.$item['image'])}}">
                                  </div>
                                @endif
                              @endforeach
                            </div>
                            <div class="table">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Type</th>
                                    <th>Harga</th>
                                    <th class="text-center">Chat</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($products as $item)
                                    @if ($product_detail['product_type_id'] == $item['product_type_id'])
                                      <tr>
                                        <td width="40%">
                                          <a href="{{route('public.product_detail', $item['id'])}}"><h6 class="fw-bold mb-0">{{$item['name']}}</h6></a>
                                        </td>
                                        <td>{{Helper::helper_number_format($item['price'])}}</td>
                                        <td>
                                          <center>
                                            <a href="https://wa.me/+{{$contact['whatsapp_number']}}?text={{$contact['text_message']}}" target="_blank">
                                              <img class="logo_wa_car_detail" src="{{asset('template/logo/wa.png')}}" alt="wa">
                                            </a>
                                          </center>
                                        </td>
                                      </tr>
                                    @endif
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tab-pane-2">
                      <div class="row g-4">
                          <div class="col-md-12">
                            @if (!empty($product_detail['brochure']))
                              <div class="brochure-detail">
                                @foreach ($product_detail['brochure'] as $value)
                                  <div style="margin-bottom: 1rem;">
                                    <a href="{{ asset('/storage/products/brochure/'.$value['brochure']) }}" download>Download Brosur<br>{{$value['brochure']}}</a>
                                  </div>
                                @endforeach
                              </div>          
                            @else
                              <h1>Brosur Tidak Tersedia</h1>
                            @endif

                            @if (!empty($product_detail['images']))
                              {{-- <div class="owl-carousel testimonial-carousel position-relative"> --}}
                                @foreach ($product_detail['images'] as $key => $image)
                                  {{-- <div class="testimonial-item text-center"> --}}
                                    <img class="img-brosure bg-light p-2 mx-auto mb-3" src="{{asset('/storage/products/'.$image['images'])}}" id="imgShowDetail_{{$key}}">
                                    @include('public.partials.image_fullscreen', ['image' => $image['images'], 'key' => $key, 'path' => '/storage/products/', 'attr_id' => 'imageFullscreen'])
                                  {{-- </div> --}}
                                @endforeach
                              {{-- </div> --}}
                            @else
                              <h1>Gambar tidak ditemukan</h1>
                            @endif
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tab-pane-3">
                      <div class="row g-4">
                          <div class="col-md-12">
                            @if (!empty($product_detail['specification_images']))
                              @foreach ($product_detail['specification_images'] as $key => $image)
                                <img class="img-specification bg-light p-2 mx-auto mb-3" src="{{asset('/storage/products/specification/'.$image['images'])}}" id="imgShowDetailSpesifikasi_{{$key}}" width="100%">
                                @include('public.partials.image_fullscreen', ['image' => $image['images'], 'key' => $key, 'path' => '/storage/products/specification/', 'attr_id' => 'imageFullscreenSpesifikasi'])
                              @endforeach
                            @endif
                            <span>{!! $product_detail['specification'] !!}</span>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tab-pane-4">
                      <div class="row g-4">
                          <div class="col-md-12">
                            @if (!empty($product_detail['products_installments']))
                              <div class="table">
                                <table class="table table-responsive table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th>Tenor</th>
                                      <th>Angsuran</th>
                                      <th>TDP</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($product_detail['products_installments'] as $item)
                                      <tr>
                                        <td width="30%">{{$item['tenor']['tenor'].' '.$item['tenor']['unit']}}</td>
                                        <td width="30%">{{Helper::helper_number_format($item['price_installment'])}}</td>
                                        <td width="30%">{{Helper::helper_number_format($item['tdp'])}}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                              <a href="{{route('public.credits.credit_simulation')}}" class="btn btn-primary py-3 px-5">Simulasi Kredit<i class="fa fa-arrow-right ms-3"></i></a>
                            @else
                              <h3>Cicilan / Kredit tidak tersedia</h3>
                            @endif
                          </div>
                      </div>
                  </div>

                  <div class="tab-pane fade" id="tab-pane-5">
                      <div class="row g-4">
                          <div class="col-md-12">
                            <span>{!! $product_detail['description'] !!}</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      {{-- <div class="mt-5 mb-5">
      	<h1 class="text-uppercase">Mobil Terkait</h1>
			  <div class="row g-4" id="product_car_cat" data-car_cat="{{$product_detail['product_type_id']}}"></div>
      </div> --}}
    </div>
  </div>
@endsection

@section('script')
	<script type="text/javascript">
	    $(document).ready(function(){
        $('.img-brosure').each((index, item) => {
          $(`#imgShowDetail_${index}`).on('click', function(){
            $(`#imageFullscreen_${index}`).modal('show')
          })
        })
        $('.img-specification').each((index, item) => {
          $(`#imgShowDetailSpesifikasi_${index}`).on('click', function(){
            $(`#imageFullscreenSpesifikasi_${index}`).modal('show')
          })
        })

        // $('#imgShowDetail').on('click', function(){
        //   $('#imageFullscreen').modal('show')
        // })
	    })
	</script>
@endsection

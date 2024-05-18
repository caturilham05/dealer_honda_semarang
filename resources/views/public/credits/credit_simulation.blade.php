@extends('public.layout.public')

@section('content')
  <div class="container-xxl py-5">
      <div class="container">
          <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
              <h6 class="text-primary text-uppercase">Katalog</h6>
              <h1 class="mb-1 text-uppercase">{{$title}}</h1>
          </div>
      </div>
  </div>

  <div class="container-xxl">
    <div class="container">
      <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfLi0ZErnNt3OPWyTSMbG-zDpKm_T2i-US9GQnS2WZWPow7oQ/viewform?embedded=true" width="100%" height="2500" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
      {{-- <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScrQVPZDRyMOCpzYgd_jymM2jZwhvYbY6ox9To8SBAuBBhUsQ/viewform?embedded=true" width="100%" height="2500" frameborder="0" marginheight="0" marginwidth="0">Memuat…</iframe> --}}
      {{-- <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
          <label>Tipe Mobil</label>
          <select class="form-control" name="product_type_id" id="product_type_id">
            <option value="">Pilih Tipe Mobil</option>
            @foreach ($product_types as $item)
              <option value="{{$item['id']}}">{{$item['name']}}</option>
            @endforeach
          </select>
          <small style="color: #D81324 !important;">Silahkan Pilih tipe mobil terlebih dahulu untuk melakukan simulasi kredit</small>
        </div>

        <div id="product_type_ajax">
          <div class="form-group mb-3">
            <label>Nama Mobil</label>
            <select class="form-control" name="name" id="car_name"></select>
          </div>
        </div>
        <div id="car_ajax"></div>
      </form> --}}
    </div>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#product_type_ajax').css('display', 'none');
      $('#product_type_id').on('change', function(){
        let productTypeId = $(this).val()
        if (productTypeId !== '') {
          $('#product_type_ajax').css('display', 'block');
          $.ajax({
            url: `/credit-simulation/product-types/${productTypeId}`,
            type: 'get',
            dataType: 'json',
            beforeSend:function(){
              $('#car_name').html('<option value="">Loading...</option>');
            },
            success:function(res){
              console.log(res)
              $('#car_name').html(res.html);
            }
          })
        } else {
          $('#product_type_ajax').css('display', 'none');
          $('#car_name').html('');
          $('#car_ajax').html('');
        }
      })

      $('#car_name').on('change', function(){
        let carId = $(this).val();
        if (carId !== '') {
          $.ajax({
            url: `/credit-simulation/car/${carId}`,
            type: 'get',
            dataType: 'json',
            beforeSend:function(){
              $('#car_ajax').html('<center><h1>Loading...</h1></center>');
            },
            success:function(res){
              console.log(res)
              $('#car_ajax').html(res.html);
            }
          })
        } else {
          $('#car_ajax').html('');
        }
      })
    })
  </script>
@endsection
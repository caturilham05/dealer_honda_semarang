@extends('admin.layout.admin')

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.products_list')}}">{{$title}}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card">
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.products.update_product', $product['id'])}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            @if ($product_types->isEmpty())
              <div class="mb-3">
                <span style="color: red;"><b>tipe Mobil tidak ditemukan. Silahkan tambah tipe Mobil terlebih dahulu</b></span>
                <a href="{{route('admin.products.product_type_create')}}" style="text-decoration: underline;"> Tambah tipe Mobil</a>
              </div>
            @else
              <div class="form-group">
                <label>Tipe Mobil</label>
                <select class="form-control @error('product_type_id') is-invalid @enderror" name="product_type_id">
                  <option value="">Pilih Tipe Mobil</option>
                  @foreach ($product_types as $item)
                    <option value="{{$item->id}}" {{ ( $item->id == $product->product_type_id) ? 'selected' : '' }}>{{$item->name}}</option>

                  @endforeach
                </select>
                @error('product_type_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
                <span><a href="{{route('admin.products.product_type_create')}}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah tipe Mobil baru</a></span>
              </div>
            @endif

            @if ($promos->isEmpty())
              <div class="mb-3">
                <span style="color: red;"><b>promo tidak ditemukan. Silahkan tambah promo terlebih dahulu</b></span>
                <a href="{{route('admin.products.promo_create')}}" style="text-decoration: underline;"> Tambah promo baru</a>
              </div>
            @else
              <div class="form-group">
                <label>Promo</label>
                <select class="form-control" name="promo_id">
                  <option value="">Pilih Promo</option>
                  @foreach ($promos as $item)
                    <option value="{{$item->id}}" {{ ( $item->id == $product->promo_id) ? 'selected' : '' }}>{{$item->name}}</option>
                  @endforeach
                </select>
                <span><a href="{{route('admin.products.promo_create')}}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah promo baru</a></span>
              </div>
            @endif

            <div class="form-group">
              <label for="name">Nama Mobil</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $product['name'])}}" placeholder="Nama Mobil">
              @error('name')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="price">Harga Mobil</label>
              <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('name', $product['price'])}}" placeholder="Harga Mobil">
              @error('price')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="tdp">Total Down Payment</label>
              <input type="text" class="form-control" id="tdp" name="tdp" value="{{old('name', $product['tdp'])}}" placeholder="TDP">
            </div>

            @if ($product->products_installments->isEmpty())
              <div class="form-group">
                <label for="price_installment">Angsuran 1</label>
                <input type="text" class="form-control" id="price_installment_1" name="price_installment[]" placeholder="Angsuran 1">
              </div>

              <div class="form-group">
                <label for="price_installment">Angsuran 2</label>
                <input type="text" class="form-control" id="price_installment_2" name="price_installment[]" placeholder="Angsuran 2">
              </div>

              <div class="form-group">
                <label for="price_installment">Angsuran 3</label>
                <input type="text" class="form-control" id="price_installment_3" name="price_installment[]" placeholder="Angsuran 3">
              </div>
            @else
              @php
                $key = 1;
              @endphp
              @foreach ($product->products_installments as $item)
                <div class="form-group">
                  <label for="price_installment">Angsuran {{$key++}}</label>
                  <input type="hidden" class="form-control" id="id_installment" name="id_installment[]" placeholder="Angsuran {{$key}}" value="{{$item['id']}}">
                  <input type="text" class="form-control" id="price_installment_{{$key}}" name="price_installment[]" placeholder="Angsuran {{$key}}" value="{{$item['price_installment']}}">
                </div>
              @endforeach
            @endif


            <div class="form-group">
              <label for="specification">Spesifikasi Mobil</label>
              <textarea id="summernote" name="specification">{{old('specification', $product['specification'])}}</textarea>
            </div>

            <div class="form-group">
              <label for="special_feature">Fitur Spesial</label>
              <textarea id="summernote1" name="special_feature">{{old('special_feature', $product['special_feature'])}}</textarea>
            </div>

            <div class="form-group">
              <label for="description">Deskripsi Mobil</label>
              <textarea id="summernote2" name="description">{{old('description', $product['description'])}}</textarea>
            </div>

            <div class="form-group">
              <label for="images">Unggah Gambar Mobil</label>
              <div class="col-md-6">
                <input type="file" class="form-control" name="images[]" multiple>
              </div>
            </div>

            <div class="form-check">
              <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{!empty($product->is_active) ? 'checked' : ''}}>
              <label class="form-check-label" for="is_active">Aktif / Tidak Aktif</label>
            </div>

          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            @if (!$product_types->isEmpty())
              <button type="submit" class="btn btn-primary">Submit</button>
            @endif
          </div>
        </form>
    </div>
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      number_custom('#price');
      number_custom('#tdp');
      number_custom('#price_installment_1');
      number_custom('#price_installment_2');
      number_custom('#price_installment_3');

      $('#summernote').summernote({
        height: 300,
        focus: false
      })

      $('#summernote1').summernote({
        height: 300,
        focus: false
      })

      $('#summernote2').summernote({
        height: 300,
        focus: false
      })

      function number_custom(index) {
        $('body').on('keyup', index, function(event) {
          if(event.which >= 37 && event.which <= 40) return;
          // format number
          $(this).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          });
        });
      }
    })
  </script>
@endsection
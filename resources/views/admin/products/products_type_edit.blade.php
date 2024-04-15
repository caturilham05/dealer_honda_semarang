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
                        <li class="breadcrumb-item"><a href="{{route('admin.products_type')}}">{{$title}}</a></li>
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
        <form action="{{route('admin.products.product_type_update', $item['id'])}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="name">Nama Mobil</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $item['name'])}}" placeholder="Nama Promo">
              @error('name')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="price">Harga Mobil</label>
              <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price', $item['price'])}}" placeholder="Harga Mobil">
              @error('price')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="years">Tahun Mobil</label>
              <input type="text" class="form-control @error('years') is-invalid @enderror" id="years" name="years" value="{{old('years', $item['years'])}}" placeholder="Tahun Mobil">
              @error('years')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-check">
              <input type="checkbox" name="is_active" class="form-check-input" id="is_active">
              <label class="form-check-label" for="is_active">Aktif / Tidak Aktif</label>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
    </div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('body').on('keyup', '#price', function(event) {
      if(event.which >= 37 && event.which <= 40) return;
      // format number
      $(this).val(function(index, value) {
        return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      });
    });
  })
</script>
@endsection
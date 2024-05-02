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
                        <li class="breadcrumb-item"><a href="{{route('admin.images.imageslider')}}">{{$title}}</a></li>
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
        <form action="{{route('admin.images.imageslider_store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            @if ($imageslider_categories->isEmpty())
              <div class="mb-3">
                <span style="color: red;"><b>kategori tidak ditemukan. Silahkan tambah kategori terlebih dahulu</b></span>
                <a href="{{route('admin.images.imageslider_category_create')}}" style="text-decoration: underline;"> Tambah Kategori</a>
              </div>
            @else
              <div class="form-group">
                <label>Kategori Gambar</label>
                <select class="form-control @error('cat_id') is-invalid @enderror" name="cat_id">
                  <option value="">Pilih Kategori Gambar</option>
                  @foreach ($imageslider_categories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                </select>
                @error('cat_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
                <span><a href="{{route('admin.images.imageslider_category_create')}}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Kategori</a></span>
              </div>
            @endif

            <div class="form-group">
              <label for="images">Unggah Gambar</label>
              <div class="col-md-6">
                <input type="file" class="form-control" name="images[]" multiple required>
              </div>
            </div>

						<div class="form-check">
							<input type="checkbox" name="is_active" class="form-check-input" id="is_active">
							<label class="form-check-label" for="is_active">Aktif / Tidak Aktif</label>
						</div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            @if (!$imageslider_categories->isEmpty())
              <button type="submit" class="btn btn-primary">Submit</button>
            @endif
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
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
                        <li class="breadcrumb-item"><a href="{{route('admin.products.product_type_create')}}">{{$title}}</a></li>
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
        <form action="{{route('admin.images.imageslider_category_store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name">Kategori Gambar</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Kategori Gambar">
              @error('name')
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
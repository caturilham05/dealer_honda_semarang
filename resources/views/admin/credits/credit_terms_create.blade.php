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
                        <li class="breadcrumb-item"><a href="{{route('admin.credit_terms')}}">{{$title}}</a></li>
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
        <form action="{{route('admin.credit_terms_store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea id="summernote" name="description" class="@error('description') is-invalid @enderror"></textarea>
              @error('description')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="images">Unggah Gambar</label>
              <div class="col-md-6">
                <input type="file" class="form-control" name="images[]" multiple>
              </div>
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
      $('#summernote').summernote({
        height: 300,
        focus: true
      })
	})
</script>
@endsection
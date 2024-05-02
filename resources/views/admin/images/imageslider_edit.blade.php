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
        <form action="{{route('admin.images.imageslider_update', $imageslider['id'])}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            @if ($category->isEmpty())
              <div class="mb-3">
                <span style="color: red;"><b>kategori tidak ditemukan. Silahkan tambah kategori terlebih dahulu</b></span>
                <a href="{{route('admin.images.imageslider_category_create')}}" style="text-decoration: underline;"> Tambah Kategori</a>
              </div>
            @else
              <div class="form-group">
                <label>Kategori</label>
                <select class="form-control @error('cat_id') is-invalid @enderror" name="cat_id">
                  <option value="">Pilih Kategori</option>
                  @foreach ($category as $item)
                    <option value="{{$item->id}}" {{ ( $item->id == $imageslider->cat_id) ? 'selected' : '' }}>{{$item->name}}</option>

                  @endforeach
                </select>
                @error('cat_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
                <span><a href="{{route('admin.images.imageslider_category_create')}}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Kategori baru</a></span>
              </div>
            @endif

            <div class="form-group">
              <label for="images">Unggah Gambar Mobil</label>
              <div class="col-md-6">
                <input type="file" class="form-control" name="images[]" multiple>
              </div>
            </div>

            <div class="form-check">
              <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{!empty($imageslider->is_active) ? 'checked' : ''}}>
              <label class="form-check-label" for="is_active">Aktif / Tidak Aktif</label>
            </div>

          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            @if (!$category->isEmpty())
              <button type="submit" class="btn btn-primary">Submit</button>
            @endif
          </div>
        </form>
    </div>
@endsection
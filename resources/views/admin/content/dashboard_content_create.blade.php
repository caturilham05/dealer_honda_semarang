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
        <form action="{{route('admin.dashboard.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            @if ($content_types->isEmpty())
              <div class="mb-3">
                <span style="color: red;"><b>tipe konten tidak ditemukan. Silahkan tambah tipe konten terlebih dahulu</b></span>
                <a href="{{route('admin.content_type.create')}}" style="text-decoration: underline;"> Tipe Konten</a>
              </div>
            @else
              <div class="form-group">
                <label>Tipe Konten</label>
                <select class="form-control @error('content_type_id') is-invalid @enderror" name="content_type_id">
                  <option value="">Pilih Tipe Konten</option>
                  @foreach ($content_types as $item)
                    <option value="{{$item->id}}">{{$item->title}}</option>
                  @endforeach
                </select>
                @error('content_type_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
                <span><a href="{{route('admin.content_type.create')}}"><i class="fas fa-plus"></i>&nbsp; Tipe Konten</a></span>
              </div>
            @endif

            <div class="form-group">
              <label for="title">Judul Konten</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Judul Konten">
              @error('title')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="intro">Intro Konten</label>
              <input type="text" class="form-control @error('intro') is-invalid @enderror" id="intro" name="intro" placeholder="Intro Konten">
            </div>

            <div class="form-group">
              <label for="keyword">Keyword Konten</label>
              <input type="text" class="form-control @error('keyword') is-invalid @enderror" id="keyword" name="keyword" placeholder="Keyword Konten">
            </div>

            <div class="form-group">
              <label for="tags">Tags Konten</label>
              <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" placeholder="tags Konten">
            </div>

            <div class="form-group">
              <label for="content">Konten</label>
              <textarea id="summernote" name="content"></textarea>
              @error('content')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="images">Unggah Gambar Mobil</label>
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
            @if (!$content_types->isEmpty())
              <button type="submit" class="btn btn-primary">Submit</button>
            @endif
          </div>
        </form>
    </div>
@endsection

@section('script')
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote({
      height: 300,
      focus: false
    })
  })
</script>
@endsection
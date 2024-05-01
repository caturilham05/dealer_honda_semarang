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
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{$title}}</a></li>
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
        <form action="{{route('admin.dashboard.update', $content['id'])}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            @if ($content_types->isEmpty())
              <div class="mb-3">
                <span style="color: red;"><b>tipe konten tidak ditemukan. Silahkan tambah tipe konten terlebih dahulu</b></span>
                <a href="{{route('admin.products.product_type_create')}}" style="text-decoration: underline;"> Tambah Tipe Konten</a>
              </div>
            @else
              <div class="form-group">
                <label>Tipe Konten</label>
                <select class="form-control @error('content_type_id') is-invalid @enderror" name="content_type_id">
                  <option value="">Pilih Tipe Konten</option>
                  @foreach ($content_types as $item)
                    <option value="{{$item->id}}" {{ ( $item->id == $content->content_type_id) ? 'selected' : '' }}>{{$item->title}}</option>

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
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title', $content['title'])}}" placeholder="Judul Konten">
              @error('title')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="intro">Intro Konten</label>
              <input type="text" class="form-control" id="intro" name="intro" value="{{old('intro', $content['intro'])}}" placeholder="Intro Konten">
            </div>

            <div class="form-group">
              <label for="keyword">keyword Konten</label>
              <input type="text" class="form-control" id="keyword" name="keyword" value="{{old('keyword', $content['keyword'])}}" placeholder="keyword Konten">
            </div>

            <div class="form-group">
              <label for="tags">tags Konten</label>
              <input type="text" class="form-control" id="tags" name="tags" value="{{old('tags', $content['tags'])}}" placeholder="tags Konten">
            </div>

            <div class="form-group">
              <label for="content">Konten</label>
              <textarea id="summernote" name="content">{!!Helper::helper_nl2br(old('content', $content['content']))!!}</textarea>
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
              <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{!empty($content->is_active) ? 'checked' : ''}}>
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
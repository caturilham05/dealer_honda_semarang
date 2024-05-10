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
                        <li class="breadcrumb-item"><a href="{{route('admin.contact')}}">{{$title}}</a></li>
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
        <form action="{{route('admin.contact.update', $item['id'])}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="whatsapp_number">Nomor HP (Whatsapp)</label>
              <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" id="whatsapp_number" name="whatsapp_number" value="{{old('whatsapp_number', $item['whatsapp_number'])}}" placeholder="Nomor HP (Whatsapp)">
              @error('whatsapp_number')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="address">Alamat</label>
              <textarea class="form-control" rows="3" name="address" placeholder="Alamat Lengkap">{{old('address', $item['address'])}}</textarea>
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea class="form-control" rows="3" name="description" placeholder="Alamat Lengkap">{{old('description', $item['description'])}}</textarea>
            </div>
            <div class="form-group">
              <label for="url_google_maps">URL Google Maps</label>
              <textarea class="form-control" rows="3" name="url_google_maps" placeholder="Alamat Lengkap">{{old('url_google_maps', $item['url_google_maps'])}}</textarea>
            </div>
            <div class="form-group">
              <label for="text_message">Isi Pesan</label>
              <textarea class="form-control" rows="3" name="text_message" placeholder="Isi Pesan">{{old('text_message', $item['text_message'])}}</textarea>
            </div>
            <div class="form-group">
              <label for="social_media">Sosial Media</label>
              <input type="text" class="form-control" id="social_media" name="social_media" value="{{old('social_media', $item['social_media'])}}" placeholder="Sosial Media">
            </div>
            <div class="form-check">
              <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{!empty($item['is_active']) ? 'checked' : ''}}>
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
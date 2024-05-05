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
                        <li class="breadcrumb-item"><a href="{{route('admin.testimonial')}}">{{$title}}</a></li>
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
      <form action="{{route('admin.testimonial_store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Nama Testimonial</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Testimonial">
            @error('name')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="description">Deskripsi Testimonial</label>
            <textarea class="form-control" rows="3" name="description" placeholder="Deskripsi Testimonial"></textarea>
            @error('description')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="image">Unggah Foto</label>
            <div class="col-md-6">
              <input type="file" class="form-control" name="image">
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
  </div>
@endsection
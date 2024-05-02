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
                        <li class="breadcrumb-item"><a href="{{route('admin.navbars.create')}}">{{$title}}</a></li>
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
        <form action="{{route('admin.navbars.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name">Nama Menu</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Menu">
              @error('name')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="route">Route</label>
              <input type="text" class="form-control @error('route') is-invalid @enderror" id="route" name="route" placeholder="Nama Menu">
              <small>contoh: admin.dashboard atau public.dashboard</small>
              @error('route')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="prefix">Prefix</label>
              <input type="text" class="form-control @error('prefix') is-invalid @enderror" id="prefix" name="prefix" placeholder="Nama Menu">
              @error('prefix')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Pilih Publish</label>
              <select class="form-control @error('is_admin') is-invalid @enderror" name="is_admin">
                <option value="">Pilih Publish</option>
                <option value="0">Tampil di publik</option>
                <option value="1">Tampil di admin</option>
                <option value="2">Tampil di admin dan publik</option>
              </select>
              @error('is_admin')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Menu Utama</label>
              <select class="form-control @error('is_admin') is-invalid @enderror" name="par_id">
                <option value="">Pilih Menu Utama</option>
                @foreach ($menus as $menu)
                  <option value="{{$menu->id}}">{{$menu->name}} || {{$menu->route}}</option>
                @endforeach
              </select>
              @error('is_admin')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
    </div>
@endsection
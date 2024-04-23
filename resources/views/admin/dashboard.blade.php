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
  @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <span>{{ session('success') }}</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif

    <a href="{{route('admin.dashboard.create')}}">
        <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>&nbsp;&nbsp; {{$title}} Baru</button>
    </a>

    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if ($contents->isEmpty())
                <center>
                  <span>Konten tidak ditemukan</span>
                </center>
              @else
                <table class="table table-bordered table-responsive">
                  <thead>
                    <tr>
                      <th>Nama Mobil</th>
                      <th>Tipe Mobil</th>
                      <th>Harga Mobil</th>
                      <th>Promo</th>
                      <th>Spesifikasi</th>
                      <th>Foto Mobil</th>
                      <th>Aktif / Tidak Aktif</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              @endif
            </div>
            @if (!$contents->isEmpty())
                <div class="card-footer clearfix">
                {!! $contents->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            @endif
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </div>
@endsection

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
                        <li class="breadcrumb-item"><a href="{{route('admin.settings')}}">{{$title}}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if (empty($settings))
            <center>
              <span>Data tidak ditemukan</span>
            </center>
          @else            
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Pengaturan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($settings as $item)
                    <tr>
                        {{-- <td><a href="{{route('admin.navbars', ['id' => $item->id])}}">{{$item->name}}</a></td> --}}
                    </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
        <!-- /.card-body -->
      </div>
      @if (!empty($items))
        <div class="card-footer clearfix">
          {!! $items->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
      @endif
      <!-- /.card -->
    </div>
  </div>
@endsection
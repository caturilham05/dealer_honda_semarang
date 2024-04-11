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
                        <li class="breadcrumb-item"><a href="{{route('admin.navbars')}}">{{$title}}</a></li>
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

  <a href="{{route('admin.navbars.create')}}">
    <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>&nbsp;&nbsp; Buat Menu</button>
  </a>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if (empty($menus))
            <center>
              <span>Data tidak ditemukan</span>
            </center>
          @else            
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama Menu</th>
                  <th>Prefix</th>
                  <th>Prefix URL</th>
                  <th>Urutan Menu</th>
                  <th>Tampil</th>
                  <th>Aktif / Tidak Aktif</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($menus as $item)
                    @if ($item->prefix != 'navbars')                    
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->prefix}}</td>
                            <td>{{$item->route}}</td>
                            <td>{{$item->ordering}}</td>
                            <td>{{$item->is_admin == 2 ? 'Tampil di admin dan publik' : ($item->is_admin == 1 ? 'Tampil di admin' : ($item->is_admin == 0 ? 'Tampil di publik' : '-'))}}</td>
                            <td class="text-center">
                              <input type="checkbox" name="is_active" value="{{$item->is_active}}" data-id="{{$item->id}}" class="form-check-input checkbox" {{$item->is_active == 1 ? 'checked' : ''}}>
                            </td>
                        </tr>
                    @endif
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.checkbox').change(function(){
            let id = $(this).data('id')
            isChecked = 0
            if (this.checked) {
                isChecked = 1
            }
            $.ajax({
                url: `/admin/navbars/create/${id}`,
                type: 'PUT',
                data: {
                    _token: "{{csrf_token()}}",
                    is_checked: isChecked
                },
                success:function(response){
                    Swal.fire({
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
        })
    })
</script>
@endsection

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

    <a href="{{route('admin.content_type.create')}}">
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
              @if ($content_types->isEmpty())
                <center>
                  <span>Konten tidak ditemukan</span>
                </center>
              @else
                <table class="table table-bordered table-responsive">
                  <thead>
                    <tr>
                      <th>Konten Tipe</th>
                      <th>Aktif / Tidak Aktif</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($content_types as $item)                    
                      <tr>
                          <td width="20%">{{$item->title}}</td>
                          <td width="35%">
                              <input type="checkbox" name="is_active" value="{{$item->is_active}}" data-id="{{$item->id}}" class="checkbox" {{$item->is_active == 1 ? 'checked' : ''}}>
                              <label class="form-check-label" for="is_active">{{!empty($item->is_active) ? 'Aktif' : 'Tidak Aktif'}}</label>
                          </td>
                          <td class="text-center" width="10%">
                            <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data {{$item->title}} ?');" action="{{ route('admin.content_type.destroy', $item->id) }}" method="POST">
                                <a href="{{ route('admin.content_type.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
            </div>
            @if (!$content_types->isEmpty())
                <div class="card-footer clearfix">
                {!! $content_types->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            @endif
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
                url: `/admin/content-type/edit/${id}/set-active`,
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
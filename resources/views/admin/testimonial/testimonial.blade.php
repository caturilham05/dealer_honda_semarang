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
  @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <span>{{ session('success') }}</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif

  <a href="{{route('admin.testimonial_create')}}">
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
          @if ($testimonial->isEmpty())
            <center>
              <span>testimonial tidak ditemukan</span>
            </center>
          @else            
            <table class="table table-bordered table-responsive">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Foto</th>
                  <th>Deskripsi</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($testimonial as $item)
                  <tr>
                      <td width="20%">{{$item->name}}</td>
                      <td>
                        @if (!empty($item->image))
                          <img src="{{ asset('/storage/testimonial/'.$item->image) }}" style="width: 150px">
                        @else
                          -
                        @endif
                      </td>
                      <td width="45%">{{substr_replace($item->description, ' ...', 20)}}</td>
                      <td class="text-center" width="20%">
                          <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data {{$item->name}} ?');" action="{{ route('admin.testimonial_destroy', $item->id) }}" method="POST">
                              <a href="{{ route('admin.testimonial_edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
        @if (!$testimonial->isEmpty())
            <div class="card-footer clearfix">
            {!! $testimonial->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        @endif
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection

{{-- @section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.checkbox').change(function(){
            let id = $(this).data('id')
            isChecked = 0
            if (this.checked) {
                isChecked = 1
            }
            $.ajax({
                url: `/admin/products/promo/edit/${id}/set-active`,
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
@endsection --}}
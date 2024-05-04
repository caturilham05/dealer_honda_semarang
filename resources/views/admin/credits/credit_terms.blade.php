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
                        <li class="breadcrumb-item"><a href="{{route('admin.credit_terms')}}">{{$title}}</a></li>
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

  <a href="{{route('admin.credit_terms_create')}}">
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
          @if ($credits->isEmpty())
            <center>
              <span>syarat kredit tidak ditemukan</span>
            </center>
          @else
            <table class="table table-bordered table-responsive">
              <thead>
                <tr>
                  <th>Deskripsi</th>
                  <th>Gambar</th>
                  <th>Aktif / Tidak Aktif</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($credits as $item)
                	@php
                    $description = substr_replace($item->description, ' ...', 50);
                	@endphp
                  <tr>
                      <td width="20%">{!! $description !!}</td>
                      <td width="20%">
                        @if (!empty($item->image))
                          <img src="{{ asset('/storage/credit_terms/'.$item->image) }}" style="width: 150px">
                        @else
                          -
                        @endif
                      </td>
                      <td>
                          <input type="checkbox" name="is_active" value="{{$item->is_active}}" data-id="{{$item->id}}" class="checkbox" {{$item->is_active == 1 ? 'checked' : ''}}>
                          <label class="form-check-label" for="is_active">{{!empty($item->is_active) ? 'Aktif' : 'Tidak Aktif'}}</label>
                      </td>
                      <td class="text-center">
                          <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data Syarat Kredit ?');" action="{{ route('admin.credit_terms_destroy', $item->id) }}" method="POST">
                              <a href="{{ route('admin.credit_terms_edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
        {{-- @if (!$credits->isEmpty())
            <div class="card-footer clearfix">
            {!! $credits->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        @endif --}}
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
                url: `/admin/credit/credit-terms/edit/${id}/set-active`,
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
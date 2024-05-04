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
  @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <span>{{ session('success') }}</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif

    <a href="{{route('admin.contact.create')}}">
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
              @if ($contacts->isEmpty())
                <center>
                  <span>Kontak tidak ditemukan</span>
                </center>
              @else
                {{-- @include('admin.partials.product_filter') --}}
                <table class="table table-bordered table-responsive">
                  <thead>
                    <tr>
                      <th>Nomor HP (Whatsapp)</th>
                      <th>Alamat Lengkap</th>
                      <th>Deskripsi</th>
                      <th>Isi Pesan</th>
                      <th>Google Maps</th>
                      <th>Aktif / Tidak Aktif</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($contacts as $item)
                        <tr>
                            <td width="10%">{{$item->whatsapp_number}}</td>
                            <td width="10%">{{$item->address}}</td>
                            <td width="10%">{{$item->description}}</td>
                            <td width="10%">{{$item->text_message}}</td>
                            <td width="30%">{!!$item->url_google_maps!!}</td>
                            <td width="10%">
                                <input type="checkbox" name="is_active" value="{{$item->is_active}}" data-id="{{$item->id}}" class="checkbox" {{$item->is_active == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="is_active">{{!empty($item->is_active) ? 'Aktif' : 'Tidak Aktif'}}</label>
                            </td>
                            <td class="text-center" width="10%">
                              <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data {{$item->name}} ?');" action="{{ route('admin.contact.destroy', $item->id) }}" method="POST">
                                  <a href="{{ route('admin.contact.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
            @if (!$contacts->isEmpty())
                <div class="card-footer clearfix">
                {!! $contacts->withQueryString()->links('pagination::bootstrap-5') !!}
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
                url: `/admin/contact/edit/${id}/set-active`,
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
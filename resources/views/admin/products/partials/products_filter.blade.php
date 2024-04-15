<form action="" method="GET" class="d-flex justify-content-end mb-3">
  {{-- @csrf --}}
  <div class="form-row">
    <div class="col">
      <input type="text" name="name" class="form-control" value="{{request()->input('name') ?? null}}" placeholder="Nama Mobil">
    </div>
  </div>
	<button type="submit" class="btn btn-primary ml-2">Search</button>
	<a href="{{route('admin.products_list')}}" class="btn btn-warning ml-2">Reset</a>
</form>
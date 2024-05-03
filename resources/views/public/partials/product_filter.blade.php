<form action="" method="GET" class="d-flex mb-3">
  {{-- @csrf --}}
  <div class="form-group">
    <select class="form-control" name="product_type_id" id="type_car">
      <option value="">Semua Tipe Mobil</option>
      @foreach ($product_type as $item)
        <option value="{{$item['id']}}">{{$item['name']}}</option>
      @endforeach
    </select>
  </div>
</form>
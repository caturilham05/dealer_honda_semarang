<div class="mb-3 mt-3" id="multiform">
    @if (!empty($product))
    	@if (!$product->products_installments->isEmpty())
	    	@foreach ($product->products_installments as $pi)
					<div class="form-inline">
				    <select class="form-control" name="tenor[]">
				      <option value="">Pilih Jangka Waktu Tenor</option>
				      @foreach ($tenors as $tenor)
					      <option value="{{$tenor->id}}" {{ ( $pi->tenor_id == $tenor->id) ? 'selected' : '' }}>{{$tenor->tenor.' '.$tenor->unit}}</option>    	
				      @endforeach
				    </select>
						<input name="price_installment[]" type="text" class="form-control ml-2" value="{{$pi->price_installment}}" title="Max Qty" placeholder="Angsuran">
						<input name="tdp[]" type="text" class="form-control ml-2" value="{{$pi->tdp}}" title="Min Qty" placeholder="Total Down Payment (TDP)">
						@if (!request()->ajax())
							<button type="button" class="btn btn-default btn-secondary ml-2" id="btn-multiform">Tambah Angsuran</button>
						@endif
					</div>
	    	@endforeach
	    @else
				<div class="form-inline">
			    <select class="form-control" name="tenor[]">
			      <option value="">Pilih Jangka Waktu Tenor</option>
			      @foreach ($tenors as $tenor)
				      <option value="{{$tenor->id}}">{{$tenor->tenor.' '.$tenor->unit}}</option>    	
			      @endforeach
			    </select>
					<input name="price_installment[]" type="text" class="form-control ml-2" title="Max Qty" placeholder="Angsuran">
					<input name="tdp[]" type="text" class="form-control ml-2" title="Min Qty" placeholder="Total Down Payment (TDP)">
					@if (!request()->ajax())
						<button type="button" class="btn btn-default btn-secondary ml-2" id="btn-multiform">Tambah Angsuran</button>
					@endif
				</div>
    	@endif
    @else
			<div class="form-inline">
		    <select class="form-control" name="tenor[]">
		      <option value="">Pilih Jangka Waktu Tenor</option>
		      @foreach ($tenors as $tenor)
			      <option value="{{$tenor->id}}">{{$tenor->tenor.' '.$tenor->unit}}</option>    	
		      @endforeach
		    </select>
				<input name="price_installment[]" type="text" class="form-control ml-2" placeholder="Angsuran" id="price_installment">
				<input name="tdp[]" type="text" class="form-control ml-2" placeholder="Total Down Payment (TDP)" id="tdp">
				@if (!request()->ajax())
					<button type="button" class="btn btn-default btn-secondary ml-2" id="btn-multiform">Tambah Angsuran</button>
				@endif
			</div>
    @endif
</div>
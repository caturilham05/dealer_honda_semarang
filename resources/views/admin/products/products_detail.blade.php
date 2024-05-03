<div class="modal fade bd-example-modal-lg_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	{{-- <pre>
	    	@php
	    		print_r($item)
	    	@endphp
    	</pre> --}}
    	<center>
    		<div class="container m-3">
	    		<h1 style="text-transform: uppercase;">{{$item->name}} ({{Helper::helper_number_format($item->price)}})</h1>
    		</div>
    		<hr>
    	</center>
    	<div class="container">
    		<h4>TIPE MOBIL</h4>
	      <table class="table table-bordered">
	        <thead>
	          <tr>
	            <th>Tipe Mobil</th>
	            <th>Harga Mobil</th>
	            <th>Tahun</th>
	          </tr>
	        </thead>
	        <tbody>
	        	<tr>
	        		<td>{{$item->product_type->name}}</td>
	        		<td>Rp.{{Helper::helper_number_format($item->product_type->price)}}</td>
	        		<td>{{$item->product_type->years}}</td>
	        	</tr>
	        </tbody>
	      </table>
    	</div>
    	<div class="container">
    		<h4>PROMO</h4>
    		@if (!empty($item->promo))
		      <table class="table table-bordered">
		        <thead>
		          <tr>
		            <th>Nama Promo</th>
		            <th>Dekripsi</th>
		            <th>Gambar</th>
		          </tr>
		        </thead>
		        <tbody>
		        	<tr>
		        		<td>{{$item->promo->name}}</td>
		        		<td>{{$item->promo->description}}</td>
                <td>
                    @if (!empty($item->promo->images))
                    	@foreach ($item->promo->images as $image)
	                      <img src="{{ asset('/storage/promo/'.$image['images']) }}" style="width: 300px">
	                      <hr>
                    	@endforeach
                    @else
                      -
                    @endif
                </td>
		        	</tr>
		        </tbody>
		      </table>
    		@else
	    		<center><span>Mobil ini tidak memiliki promo</span></center>
    		@endif
    		<hr>
    	</div>
    	<div class="container">
    		@if (!empty($item->images))
		    	<div style="display: flex; flex-wrap: wrap;">
		    		@foreach ($item->images as $value)
							<div class="card" style="width: 15rem; margin: 0.5rem;">
							  <img class="card-img-top" src="{{ asset('/storage/products/'.$value['images']) }}" alt="{{$value['images']}}">
							</div>	    			
		    		@endforeach
		    	</div>
    		@endif
    		<div class="container mt-4">
    			<div class="row">
    				<div class="col-md-4">
    					<h4>SPESIFIKASI</h4>
			    		<span>{!! $item->specification ?? '-' !!}</span>
    				</div>
    				<div class="col-md-4">
    					<h4>FITUR SPESIAL</h4>
			    		<span>{!! $item->special_feature ?? '-' !!}</span>
    				</div>
    				<div class="col-md-4">
    					<h4>DESKRIPSI</h4>
			    		<span>{!! $item->description ?? '-' !!}</span>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	{{-- <pre>
	    	@php
	    		print_r($item)
	    	@endphp
    	</pre> --}}
    	<center>
    		<h1>{{$item->name}}</h1>
    		<hr>
    	</center>
    	<div class="container">
    		<h4>Tipe Mobil</h4>
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
	        		<td>Rp. {{number_format($item->product_type->price,2,',','.')}}</td>
	        		<td>{{$item->product_type->years}}</td>
	        	</tr>
	        </tbody>
	      </table>
    	</div>
    	<div class="container">
    		<h4>Promo</h4>
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
    	</div>
    </div>
  </div>
</div>

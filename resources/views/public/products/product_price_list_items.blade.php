<div class="container-xxl service py-3">
    <div class="container">
      <div class="row gx-5">
          <div class="col-lg-12">
			    	<div class="table">
			    		<table class="table table-responsive table-bordered table-hover">
			    			<thead>
			    				<tr>
			    					<th>Tipe Mobil</th>
			    					<th>Harga Mobil</th>
			    				</tr>
			    			</thead>
			    			<tbody>
			    				@foreach ($products as $product)
				    				<tr>
				    					<td width="50%">{{$product['name']}}</td>
				    					<td >Rp. {{Helper::helper_number_format($product['price'])}}</td>
				    				</tr>
			    				@endforeach
			    			</tbody>
			    		</table>
			    	</div>
          </div>
      </div>
    </div>
</div>

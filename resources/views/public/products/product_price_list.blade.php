@extends('public.layout.public')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">Katalog</h6>
            <h1 class="mb-5">{{$title}}</h1>
        </div>
			  @include('public.partials.product_filter')
        <div class="row g-4" id="product_price_list">
        </div>
    </div>
</div>
@endsection

@section('script')
	<script type="text/javascript">
	    $(document).ready(function(){
	    	price_list(0)

	      $('#type_car').on('change', function(){
	      	let id = ($(this).val() !== '') ? $(this).val() : 0;
	      	price_list(id)
	      })

	      async function price_list(id)
	      {
		    	await $.ajax({
		    		url: `/pricelist/items/${id}`,
		    		type: 'GET',
		    		dataType: 'json',
		    		beforeSend:function(){
		    			$('#product_price_list').html(`
		    				<center>
		    					<span>Loading...</span>
		    				</center>
		    			`);
		    		},
		    		success:function(res){
		    			console.log(res)
		    			$('#product_price_list').html(res.html);
		    		}
		    	})
	      }
	    })
	</script>
@endsection
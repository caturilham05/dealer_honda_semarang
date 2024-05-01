<div class="modal fade bd-example-modal-lg_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<center>
    		<div class="container m-3">
	    		<h1 style="text-transform: uppercase;">{{$item->title}}</h1>
    		</div>
    		<hr>
    	</center>
    	<div class="container">
    		@if (!empty($item->images))
		    	<div style="display: flex; flex-wrap: wrap;">
		    		@foreach ($item->images as $value)
							<div class="card" style="width: 15rem; margin: 0.5rem;">
						  	<img class="card-img-top" src="{{ asset('/storage/contents/'.$value['images']) }}" alt="{{$value['images']}}">
							</div>	    			
		    		@endforeach
		    	</div>
    		@endif
	  		<hr>
    	</div>
    	<div class="container">
    		<div class="mb-3">
	    		<h3>{!!$item->intro!!}</h3>
	    		<div>
		    		<span>{!!$item->keyword!!}</span>
	    		</div>
	    		<div>
		    		<small>{!!$item->tags!!}</small>
	    		</div>
    		</div>
    		<content>
    			{!!$item->content!!}
    		</content>
    	</div>
    </div>
  </div>
</div>

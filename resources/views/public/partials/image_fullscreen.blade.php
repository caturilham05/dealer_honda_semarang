@php
$id_index = isset($key) ? 'imageFullscreen_'.$key : 'imageFullscreen';
@endphp
<div id="{{$id_index}}" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	{{-- <pre>
    		@php
    		print_r($image)
    		@endphp
    	</pre> --}}
      <img class="bg-light mx-auto mb-3" src="{{asset($path.$image)}}" width="100%" id="imgShow">
    </div>
  </div>
</div>
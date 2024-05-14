@php
$id_index = isset($key) ? $attr_id.'_'.$key : 'imageFullscreen';
@endphp
<div id="{{$id_index}}" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <img class="bg-light mx-auto mb-3" src="{{asset($path.$image)}}" width="100%" height="100%" id="imgShow">
    </div>
  </div>
</div>
@php
    $title = $name;
@endphp

@extends('site.layouts.master')

@section('content')

    <div class="row mt-5">
        <div class="col-md-12 text-left">
            <h3>{{$name}}</h3>
            <div class="img-thumbnail">
            <iframe src="{{$url}}" width="100%" style="height: 100vh;" frameborder="0" ></iframe>
            </div>
        </div>
    </div>

    <script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
  }

  function setHeight() {
    parent.document.getElementById('the-iframe-id').style.height = document['body'].offsetHeight + 'px';
}
</script>
@stop
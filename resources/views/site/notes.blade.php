@php
$title = 'هل تعلم';
@endphp

@extends('site.layouts.master')
@section('content')


    <div class="row justify-content-center mt-5">
        <div class="col-md-10 text-left">

            @foreach ($notes as $note)
                <div class="img-thumbnail mt-3 p-2">
                    <h4 class=""> <span class="info-box-icon t-bl"><i class="fa fa-brain"></i></span>
                        <span class="note text-muted">{{ $note->name }}</span>
                    </h4>

                </div>
            @endforeach

            {{ $notes->links() }}

        </div>
    </div>
    </div>
@stop

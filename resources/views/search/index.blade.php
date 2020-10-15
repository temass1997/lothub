@extends('layouts.app')

@section('content')
    @include('search.elements.form')

    <div class="row">
        <div class="col-md-6">Map</div>
        <div class="col-md-6">
            @include('search.elements.results')
        </div>
    </div>
@endsection

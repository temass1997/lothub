@extends('layouts.app')

@section('content')
    @include('search.elements.form')

    <div class="search-result">
        @include('search.elements.map')
        @include('search.elements.results')
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <form action="/" class="js-search-form">
                        <label for="q">Zip Code</label>
                        <input type="text" name="q" id="q">
                        <label for="pageSize">Page Size</label>
                        <input type="text" name="pageSize" id="pageSize" value="500">
                        <label for="limit">Limit</label>
                        <input type="text" name="limit" id="limit" value="500">
                        <input type="submit" value="Search">
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="js-total">
                        Total:
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="simple-result">
                <div class="address">Address</div>
                <div class="legal1">Address with lot</div>
            </div>
            <div class="js-results"></div>
            <div class="js-simple-result simple-result">
                <div class="address"></div>
                <div class="legal1"></div>
            </div>
        </div>
    </div>
@endsection

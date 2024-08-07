@extends('front.layouts.master')

@section('title', $category->name . ' Kategorisi')

@section('content')
    <div class="row">
        <div class="col-md-7 mx-auto">
            @include(('front.widgets.articlelist'))
        </div>


            @include('front.widgets.categoryWidget')

@endsection

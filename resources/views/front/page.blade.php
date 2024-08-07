@extends('front.layouts.master')

@section('title', $page->title)
@section('bg',$page->image)

@section('content')
    <div class="row">
        <div class="col-md-7 mx-auto">
           {!! $page->content !!}

            </div>
@include('front.widgets.categoryWidget')
@endsection

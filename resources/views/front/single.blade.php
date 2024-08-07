@extends('front.layouts.master')

@section('title', $article->title)

@section('content')
    <div class="row">
    <div class="col-md-7 mx-auto">
                    {!! $article->content !!}
                </div>

@include('front.widgets.categoryWidget')
@endsection

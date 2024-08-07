@extends('back.layouts.master')
@section('title',$article->title.' makalesini güncelle')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')

        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as  $error)
                       <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('admin.makaleler.update',$article->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title">Makale Başlığı</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{$article->title}}" required>
                </div>
                <div class="form-group">
                    <label for="category">Makale Kategorisi</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Seçim Yapınız</option>
                        @foreach($categories as $category)
                            <option {{ $article->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Makale Fotoğrafı</label><br />
                    <img src="{{asset($article->image)}}" width="400"/>
                    <input type="file" id="image" name="image" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="title">Makale İçeriği</label>
                    <textarea id="editor" name="content" class="form-control" rows="10">{!! $article->content !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Makaleyi Güncelle</button>
                </div>


            </form>

        </div>
    </div>

@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote(
                {
                    'height':400
                }
            );
        });
    </script>
@endsection

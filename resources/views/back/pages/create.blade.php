@extends('back.layouts.master')
@section('title','Sayfa Oluştur')
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
                <form method="post" action="{{ route('admin.page.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Sayfa Başlığı</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Sayfa Fotoğrafı</label>
                        <input type="file" id="image" name="image" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Sayfa İçeriği</label>
                        <textarea id="editor" name="content" class="form-control" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Sayfayı Oluştur</button>
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
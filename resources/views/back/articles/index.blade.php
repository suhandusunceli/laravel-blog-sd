@extends('back.layouts.master')
@section('title','Tüm Makaleler')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-2 font-weight-bold text-primary d-flex justify-content-between align-items-center">@yield('title')
                <span class="float-right">{{ $articles->count() }} makale bulundu.</span>
                 <a href="{{route('admin.trashed.article')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Silinen Makaleler </a>
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Oluşturma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>


                                <img src="{{ asset($article->image) }}" width="200" height="100">

                            </td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->getCategory->name }}</td>
                            <td>{{ $article->hit}}</td>
                            <td>{{ $article->created_at->format('Y/m/d') }}</td>
                            <td>
                                <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($article->status==1) checked @endif data-toggle="toggle">


                            <td>
                                <!-- İşlemler butonları buraya eklenebilir -->
                                <a target="_blank" href="{{route('single',[$article->getCategory->slug,$article->slug])}}"title="Görüntüle" class="btn btn-success"><i class="fas fa-eye"></i> </a>
                                <a href="{{route('admin.makaleler.edit',$article->id)}}"title="Düzenle" class="btn btn-primary"><i class="fas fa-pen"></i> </a>
                                <a href="{{route('admin.delete.article',$article->id)}}"title="Sil" class="btn btn-danger"><i class="fas fa-times"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {
                var id = $(this).attr('article-id'); // Corrected the way to get attribute
                var statu = $(this).prop('checked'); // Corrected spelling of 'status' and prop usage

                $.ajax({
                    url: "{{ route('admin.switch') }}",
                    method: 'GET',
                    data: { id: id, statu: statu },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection


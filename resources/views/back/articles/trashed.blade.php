@extends('back.layouts.master')
@section('title','Silinen Makaleler')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-2 font-weight-bold text-primary d-flex justify-content-between align-items-center">@yield('title')
                <span class="float-right">{{ $articles->count() }} makale bulundu.</span>
                <a href="{{ route('admin.makaleler.index') }}" class="btn btn-primary btn-sm"> Makaleler </a>
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Oluşturma Tarihi</th>
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
                            <td>{{ $article->hit }}</td>
                            <td>{{ $article->created_at->format('Y/m/d') }}</td>
                            <td>
                                <a href="{{ route('admin.recover.article', $article->id) }}" title="Geri Yükle" class="btn btn-primary"><i class="fas fa-trash-restore-alt"></i></a>
                                <form action="{{ route('admin.makaleler.destroy', $article->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Kalıcı Sil"><i class="fas fa-times"></i></button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

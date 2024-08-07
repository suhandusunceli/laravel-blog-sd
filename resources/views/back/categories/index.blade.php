@extends('back.layouts.master')
@section('title', 'Tüm Kategoriler')
@section('content')

    <div class="row">
        <div class="col-md-4">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.category.create')}}">
                        @csrf
                        <div class="form group">
                            <label>Kategori Adı</label>
                            <input type="text" class="form-control" name="category" required />
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">EKLE</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Kategori Adı</th>
                                    <th>Makale Sayısı</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->articleCount() }}</td>
                                        <td>
                                            <input class="switch" category-id="{{ $category->id }}" type="checkbox"
                                                   data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"
                                                   {{ $category->status == 1 ? 'checked' : '' }} data-toggle="toggle">
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.category.destroy', ['id' => $category->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Kategoriyi Sil" class="btn btn-danger"><i class="fas fa-times"></i></button>

                                            </form>                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Silme Onayı</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-danger">Sil</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {

            $('.switch').change(function() {
                var id = $(this).attr('category-id');
                var status = $(this).prop('checked') ? 'true' : 'false';

                $.ajax({
                    url: "{{ route('admin.category.switch') }}",
                    method: 'GET',
                    data: { id: id, status: status },
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

@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-2 font-weight-bold text-primary d-flex justify-content-between align-items-center">@yield('title')
                <span class="float-right">{{ $pages->count() }} makale bulundu.</span>

            </h6>
        </div>

        <div class="card-body">
            <div id="orderSuccess"  style="display:none" class="alert alert-success">
                Sıralama Başarıyla Güncellendi
            </div>
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody id="orders">
                    @foreach($pages as $page)
                        <tr id="page_{{$page->id}}">

                            <td style="text-align: center; vertical-align: middle; width: 5%;">


                            <i  class="fas fa-bars fa-2x handle" ></i>

                            </td>
                            <td>
                                <img src="{{ asset($page->image) }}" width="200" height="100" alt="Fotoğraf">
                            </td>
                            <td>{{ $page->title }}</td>
                            <td>
                                <input class="switch" page-id="{{ $page->id }}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($page->status == 1) checked @endif data-toggle="toggle">
                            </td>
                            <td>
                                <a target="_blank" href="{{ route('page',$page->slug) }}" title="Görüntüle" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.page.edit',$page->id) }}" title="Düzenle" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('admin.page.destroy', $page->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Sil" class="btn btn-danger"><i class="fas fa-times"></i></button>
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
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script>
     $('#orders').sortable({

         handle:'.handle',
         update:function (){
            var siralama = $('#orders').sortable('serialize')
             $.get("{{route('admin.page.orders')}}?"+siralama,function (data,status){
                 $("#orderSuccess").show().delay(1000).fadeOut();

             });
         }
     });

    </script>
    <script>
        $(function() {
            $('.switch').change(function() {
                var id = $(this).attr('page-id');
                var statu = $(this).prop('checked');

                $.ajax({
                    url: "{{ route('admin.page.switch') }}",
                    method: 'POST', // Change to POST
                    data: {
                        id: id,
                        statu: statu,
                        _token: "{{ csrf_token() }}" // Include CSRF token
                    },
                    success: function(response) {
                        console.log('Update successful:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Update error:', error);
                    }
                });
            });
        });
    </script>
@endsection



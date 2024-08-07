@if(isset($categories) && count($categories) > 0)
    <div class="col-md-2 mx-auto">
        <div class="card">
            <div class="card-header">
                KATEGORİLER
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($categories as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center @if(Request::segment(2)==$category->slug) active @endif">
                        <a @if(Request::segment(2)!=$category->slug) href="{{ route('category', $category->slug) }}" @endif>{{ $category->name }}</a>
                        <span class="badge bg-primary rounded-pill">{{ $category->articleCount() }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<!-- Topbar Search -->


<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <form action="{{ route('homepage') }}" method="GET" class="form-inline">

                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small"
                           placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

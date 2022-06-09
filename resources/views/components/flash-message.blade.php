@if (flash()->message)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="{{ flash()->class }} alert-dismissible fade show">
                    {{ flash()->message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
@endif

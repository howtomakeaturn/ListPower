@if (session('message.title'))
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="alert alert-success alert-dismissible show mb-0 mt-4" role="alert">
                    <i class="fas fa-check"></i>&nbsp;
                    <strong>{{ session('message.title') }}</strong>
                    {{ session('message.description') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<section class="content-header">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    @foreach($breadcrumb->list as $key => $value)
                        @if($key == count($breadcrumb->list) - 1)
                            <li class="breadcrumb-item active">{{ $value }}</li>
                        @else
                            <li class="breadcrumb-item">{{ $value }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>

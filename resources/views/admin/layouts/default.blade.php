@extends("admin.layouts.app")

@section('body')
    <div class="row">
        <div class="col-3">
            @include("admin.layouts.navbar")
        </div>
        <div class="col-9">
            <div class="mt-5">
                @yield('content')
            </div>
        </div>
    </div>


@endsection

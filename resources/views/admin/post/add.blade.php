@extends(ADMIN_LAYOUT)

@section("content")
    <post-index :lang-data="{{ json_encode(__('post')) }}"></post-index>
@endsection
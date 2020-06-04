@extends("admin/layouts/default")
@section("content")
    <role-add></role-add>
@endsection

@section('scripts')
    <script>
        var roleAndPer = [{!! json_encode($permissions) !!}];
        console.log(roleAndPer);
        var addRoleUrl = "{{ route('role.add') }}";
        var getRoleUrl = "{{ route('role.get') }}";
        var getPermissionByRoleUrl = "{{ route('permission.get') }}";
        var assignPermissionUrl = "{{ route('permission.assign') }}";
    </script>
@endsection

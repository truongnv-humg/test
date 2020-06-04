<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $siteTitle = "Role";
        $permissions = config('permissions');
        return view("admin/role/role", compact("siteTitle", "permissions"));
    }

    public function store(Request $request)
    {
        $msgValidate = [
            'role.required' => __('message.validate.required')
        ];
        $validation = Validator::make($request->all(), [
            'role' => 'required'
        ], $msgValidate);

        if ($validation->fails()) {
            $messages = $validation->getMessageBag()->get('role');
            return $this->response(false, null, $messages[0]);
        } else {
            $roleInput = $request->input('role');
            try {
                Role::create(['name' => $roleInput]);
                return $this->response(true, null, __("message.insert.success"));
            } catch (\Exception $e) {
                return $this->response(false, null, $e->getMessage());
            }
        }
    }

    public function getRoleData(Request $request)
    {
        try {
            $data = Role::where('name', '<>', 'Super Admin')->get();
            return $this->response(true, $data, __("message.get.success"));
        } catch (\Exception $e) {
            return $this->response(true, null, __("message.get.error"));
        }

    }

    public function addPermission(Request $request)
    {
        $permissions = config('permissions');
        foreach ($permissions as $key => $value) {
            foreach ($value as $per) {
                Permission::create(['name' => strtolower($per . " " . $key)]);
            }
        }
        echo "success";
    }

    public function getPermissionByRole(Request $request)
    {
        $roleName = $request->input('role');
        try {
            $role = Role::findByName($roleName);
            $permission = $role->permissions()->get();
            return $this->response(true, $permission, __("message.get.success"));
        } catch (\Exception $e) {
            return $this->response(true, null, __("message.get.error"));
        }

    }

    public function assignPermissionRole(Request $request)
    {
        $isAssign = $request->input('is_assign');
        try {
            $role = Role::findByName($request->input('role'));
            $permission = Permission::findByName($request->input('permission'));
            if ($isAssign) {
                $role->givePermissionTo($permission);
            } else {
                $role->revokePermissionTo($permission);
            }
            return $this->response(true, null, __("message.update.success"));

        } catch (\Exception $e) {
            return $this->response(false, null, $e->getMessage());
        }

    }
}

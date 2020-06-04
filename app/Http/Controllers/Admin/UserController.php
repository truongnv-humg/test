<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userName = 'email';

    public function formLogin(Request $request)
    {
        $siteTitle = 'Login';
        return view('admin/auth/login', compact('siteTitle'));
    }

    public function login(Request $request)
    {
        $validate = $this->validateLogin($request);
        if ($validate->fails()) {

        } else {
            if (Auth::attempt($request->only([$this->userName, 'password']), $request->filled('remember'))) {
                $user = User::where("email", $request->input($this->userName))->first();
                return redirect()->intended(route("role.index"));
            } else {
                var_dump("login fail");
            }
        }


    }

    protected function validateLogin(Request $request)
    {
        return Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

    }
}

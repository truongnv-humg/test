<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected $viewIndex = "admin.post.index";
    protected $viewAdd = "admin.post.add";

    public function index(Request $request)
    {
        //dd($request->route());
        return view($this->viewIndex);
    }

    public function formAdd()
    {
        return view($this->viewAdd);
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'desc', 'content']);
        $validate = $this->validatePost($data);

        if ($validate->fails()) {
            return $this->response(501, $validate->errors(), __('message.insert.error'));
        } else {
            $post = new Post();
            foreach ($data as $key => $value) {
                $post->$key = $request->input($key);
            }

            $post->status = 1;

            try {
                $post->save();
                return $this->response(200, null, __('message.insert.success'));
            } catch (\Exception $e) {
                return $this->response(404, null, __('message.insert.error'));
            }

        }
    }

    private function validatePost($data)
    {
        return Validator::make($data, [
            'title' => 'required',
            'desc' => 'required',
            'content' => 'required'
        ]);
    }
}

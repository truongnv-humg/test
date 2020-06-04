<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Traits\CrudAction;

class MediaController extends Controller
{
    use CrudAction;

    protected $createView = 'admin.media.create';

    protected $randImage;

    public function __construct()
    {
        $this->randImage = time() . "_" . rand(1000, 9999);
    }

    public function uploadImage(Request $request)
    {
        foreach ($request->file() as $key => $value) {
            $file = $request->file($key);
            $file = $request->$key;
            try {
                $path = $request->$key->storeAs('images', IMG_NAME . $this->randImage . JPEG);
                $path = base_path() . '\\storage\\app\\' . $path;
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

    }
}

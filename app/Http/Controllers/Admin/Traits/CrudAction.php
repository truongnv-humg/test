<?php
namespace App\Http\Controllers\Admin\Traits;

Trait CrudAction
{
    public function create()
    {
        return view($this->createView);
    }
}
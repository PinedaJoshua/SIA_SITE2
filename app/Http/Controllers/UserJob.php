<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class UserJob extends BaseController
{
    public function index()
    {
        return response()->json(['message' => 'UserJob Controller is working!']);
    }
}

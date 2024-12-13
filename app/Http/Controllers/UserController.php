<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        $data["page_title"] = "Dashboard";
        return view('user.dashboard', $data);
    }
}

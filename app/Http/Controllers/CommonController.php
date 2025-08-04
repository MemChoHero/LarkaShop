<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CommonController extends Controller
{
    public function root(Request $request): View
    {
        return view('common.root');
    }
}

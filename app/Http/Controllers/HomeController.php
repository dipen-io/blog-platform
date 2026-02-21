<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        /* $posts = Post::published(); */
        return view("welcome");
    }
}

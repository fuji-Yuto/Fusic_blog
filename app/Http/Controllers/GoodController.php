<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Article;
use Illuminate\Http\Request;

class GoodController extends Controller
{

    public function store(Article $article)
    {
        $article -> good_users()->attach(Auth::id());
        return back();
    }

    public function destroy(Article $article)
    {
        $article -> good_users()->detach(Auth::id());
        return back();
    }
}

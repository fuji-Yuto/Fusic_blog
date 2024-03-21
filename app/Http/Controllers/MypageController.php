<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Auth;

class MypageController extends Controller
{
    
    public function index(Request $request)
    {
        $CurrentUserId = Auth::user()->id;

        $sort_type = $request -> sort_type ?? 'newest';
        $articles = Article::where('user_id',$CurrentUserId)->sorting($sort_type)->get();
        return view('mypage.index', ['articles' => $articles]); 
    }

    
}

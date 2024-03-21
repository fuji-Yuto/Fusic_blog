<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Auth;


class ArticleController extends Controller
{
    public function index(Request $request)
    {   
        
        $sort_type = $request -> sort_type ?? 'newest';
        $articles = Article::sorting($sort_type)->get();
    
        return view('article.index', ['articles' => $articles]);
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required'
        ]);

        if($validator -> fails()){
            return redirect()
                ->route('article.create')
                ->withInput()
                ->withErrors($validator);
        }
 
        $result = Article::create(
            $request -> merge([
                'user_id' => Auth::user()->id,
                'view' => 0
                ])->all());
        return redirect()->route('article.index');
        
    }

    public function show(string $id)
    {   
        $article = Article::where('id',$id)->first();

        // 自分以外の人が見たら閲覧数がアップする
        $currentUserId = Auth::user()->id;
        if( $article-> user_id !== $currentUserId ){
            $article -> increment('view');
        }

        return view('article.show', ['article'=>$article]);
    }

    public function edit(string $id)
    {
        $article = Article::where('id',$id)->first();
        
        return view('article.edit', ['article'=>$article]);
    }


    public function update(Request $request, string $id)
    {
        Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required'
        ])->validate();

        // if($validator -> fails()){
        //     return redirect()
        //         ->route('article.edit')
        //         ->withInput()
        //         ->withErrors($validator);
        // }

        $resulut = Article::find($id)->update($request->all());
        return redirect()->route('article.index');
    }

    public function destroy(string $id)
    {
        $result = Article::find($id)->delete();
        return redirect()->route('article.index');
    }
}

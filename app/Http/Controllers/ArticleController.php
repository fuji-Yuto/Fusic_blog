<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Auth;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        // ddd($request->sort_type);
        if(is_null($request->sort_type)){
            $articles = Article::orderBy('created_at', 'desc')->get();
        }else{
            $articles = Article::IndexSortingHandle($request->sort_type);
        }

        
        return view('article.index', ['articles' => $articles]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        $request = $request -> merge(['user_id' => Auth::user()->id])->all(); 
        $result = Article::create($request);
        return redirect()->route('article.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   

        // $debug = 'debug';
        // dd($debug);
        $article = Article::where('id',$id)->first();

        // 自分以外の人が見たら閲覧数がアップする
        $CurrentUserId = Auth::user()->id;
        if( $article-> user_id !== $CurrentUserId ){
            $article -> increment('view');
        }

        return view('article.show', ['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::where('id',$id)->first();
        
        return view('article.edit', ['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        $resulut = Article::find($id)->update($request->all());
        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Article::find($id)->delete();
        return redirect()->route('article.index');
    }

    public function mydata(){

        $CurrentUserId = Auth::user()->id;
        $articles = Article::where('user_id',$CurrentUserId)->orderBy('created_at', 'desc')->get();
        return view('article.index', ['articles' => $articles]); 
    
    }
}

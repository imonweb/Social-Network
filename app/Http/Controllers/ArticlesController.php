<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Auth;
use DB;

class ArticlesController extends Controller
{
     
    public function index()
    {
        // eloquent returning json
        
        $articles = Article::paginate(10);
        // return $articles;
        return view('articles.index', compact('articles'));
     

        // only live
        // $articles = Article::whereLive(1)->get();

        // query builder

        // $articles = DB::table('articles')->get();
        // $article = DB::table('articles')->whereLive(1)->get();
        // return $articles;
        // return $article;
        
    }
 
    public function create()
    {
        return view('articles.create');
    }

    
    public function store(Request $request)
    {
        // return $request->all();
   /*
        $article = new Article;
        $article->user_id = Auth::user()->id;
        $article->content = $request->content;
        $article->live = (boolean)$request->live;
        $article->post_on = $request->post_on;

        $article->save();
    */    
         Article::create($request->all());

         return redirect('/articles');

        // query builder
       // DB::table('articles')->insert($request->except('_token'));
  
/*
        Article::create([
                'user_id' => Auth::user()->id,
                'content' => $request->content,
                'live'    => $request->live,
                'post_on' => $request->post_on
            ]);
*/


    }

     
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.show', compact('article'));
    }

   
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

     
    public function update(Request $request, $id)
    {
        // error: live is not updating... check
        // return $request->all();
        
        $article = Article::findOrFail($id);

        if( ! isset($request->live))
            $article->update(array_merge($request->all(), ['live' => false]));
        else 
            $article->update($request->all());

        return redirect('/articles');
    }

     
    public function destroy($id)
    {
        //delete
        // $article = Article::findOrFail($id);
        // $article->delete();

        //destroy
        Article::destroy($id);
        return redirect('/articles');
    }
}

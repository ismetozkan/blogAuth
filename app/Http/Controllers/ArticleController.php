<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $deletedArticles= Article::onlyTrashed();
        $articles= Article::orderBy('created_at', 'ASC')->get();

        return view('back.articles.index', compact('articles','deletedArticles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data['categories']=Category::all();
        return view('back.articles.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

            $validator = Validator::make($request->all(), [
                'title'=>'required|min:3',
            ]);

            if ($validator->fails()) {
                return redirect()->route('articles.create')->withErrors($validator)->withInput();
            }


        $article= new Article;

            $article->title=$request->get('title');
            $article->slug=Str::slug($request->title);
            $article->category_id=$request->get('category');
            $article->content=$request->get('content');

            if ($request->hasFile('image')){
                $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads'),$imageName);
                $article->image='uploads/'.$imageName;

            }
            $article->save();

            return redirect()->route('articles.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();

        return view('back.articles.update', compact('article', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()->route('articles.create')->withErrors($validator)->withInput();
        }


        $article= Article::findOrFail($id);

        $article->title=$request->get('title');
        $article->slug=Str::slug($request->title);
        $article->category_id=$request->get('category');
        $article->content=$request->get('content');

        if ($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image='uploads/'.$imageName;

        }
        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Article::find($id)->delete();
        return redirect()->route('articles.index');
    }

    public function trash()
    {
        $articles= Article::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('back.articles.trash',compact('articles')) ;
    }

    public function callBack($id)
    {
        Article::onlyTrashed()->find($id)->restore();
        return redirect()->route('articles.index');
    }

    public function hardDelete($id)
    {
        $article= Article::onlyTrashed()->find($id);
        if(File::exists($article->image)){
            File::delete(public_path($article->image));
        }
        $article->forceDelete();
        return redirect()->route('trash');
    }

    public function changeStatus(Request $request)
    {
        $articles = Article::find($request->id);
        $articles->status = $request->status;
        $articles->save();

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageController extends Controller
{
    use SoftDeletes;

    public function index()
    {
        $deletedPages= Page::onlyTrashed();
        $pages= Page::all();

        return view('back.pages.index', compact('pages','deletedPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $pages= Page::all();
        return view('back.pages.create',compact('pages'));
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
            'title'=>'required|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.create')->withErrors($validator)->withInput();
        }

        $last= Page::orderBy('order','desc')->first();

        $page= new Page;
        $page->title=$request->get('title');
        $page->order=$last->order+1;
        $page->slug=Str::slug($request->title);
        $page->content=$request->get('content');

        if ($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='uploads/'.$imageName;

        }
        $page->save();

        return redirect()->route('pages.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages = Page::findOrFail($id);

        return view('back.pages.update', compact('pages'));
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
            'title'=>'required|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.create')->withErrors($validator)->withInput();
        }

        $page= Page::findOrFail($id);

        $page->title=$request->get('title');
        $page->slug=Str::slug($request->title);
        $page->content=$request->get('content');

        if ($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='uploads/'.$imageName;
        }
        $page->save();

        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Page::find($id)->delete();
        return redirect()->route('pages.index');
    }

    public function callBack($id)
    {
        Page::onlyTrashed()->find($id)->restore();
        return redirect()->route('pages.index');
    }

    public function hardDelete($id)
    {
        $page= Page::onlyTrashed()->find($id);
        if(File::exists($page->image)){
            File::delete(public_path($page->image));
        }
        $page->forceDelete();
        return redirect()->route('trash.page');
    }

    public function trash(){
        $pages= Page::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('back.pages.trash',compact('pages')) ;
    }
    public function show(){
        $pages= Page::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('back.pages.trash',compact('pages')) ;
    }


}

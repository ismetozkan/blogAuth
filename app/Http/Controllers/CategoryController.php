<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryController extends Controller
{
    use SoftDeletes;

    public function index()
    {
        $categories= Category::all();
        return view('back.categories.index',compact('categories'));
    }

    public function create(Request $request)
    {
        $isExist=Category::whereSlug(Str::slug($request->category))->first();
        if($isExist){
            return 'There is already category like this';
        }
        $category= new Category;
        $category->name= $request->category;
        $category->slug=Str::slug($request->category);
        $category->save();

        return redirect()->route('category.index');
    }

    public function edit(Request $request,$id)
    {
        $categories = Category::findOrFail($id);

        return view('back.categories.update', compact( 'categories'));

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
        ]);
        if ($validator->fails()) {
            return redirect()->route('category.index')->withErrors($validator)->withInput();
        }
        $categories = Category::findOrFail($id);
        $categories->name=$request->get('name');

        $isExist=Category::whereName($request->name)->whereNotIn('id',[$request->id])->first();
        if($isExist){
            return 'There is already category like this';
        }

        $categories->save();

        return redirect()->route('category.index');
    }




    public function delete($id)
    {
        $category= Category::findOrFail($id);
        if($category->id==1){
            return response()->json([
               'message'=>'This Category Can Not Be Deleted!!'
            ]);
        }
        $result= Category::find($id)->articleNum();
        if($result > 0){
               Article::where('category_id',$category->id)->update(['category_id'=>1]);
            return response()->json([
                'message'=>'This Category Moved To Common Section!!'
            ]);
        }
        Category::find($id)->delete();
        return redirect()->route('category.index');
    }
}

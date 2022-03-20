<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Article;
use App\Models\Category;

use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        $contacts=Contact::all();
        $articles=Article::all()->count();
        $hit=Article::sum('hit');
        $categories=Category::all()->count();
        return view('back.adminPanel',compact('contacts','articles','categories','hit'));
    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class BlogHomeController extends Controller
{
    public function __construct()
    {
        if(Setting::find(1)->status==0){
            return redirect()->to('maintenance')->send();
        }

        view()->share('pages',Page::orderBy('order','ASC')->get());
        view()->share('categories',Category::all());
    }

    public function index()
    {
        $data['articles'] = Article::orderBy('created_at', 'DESC')->where('status',1)->paginate(2);

        return view('front.homepage', $data);
    }

    public function single(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->first() ?? abort('403', 'There is no article like this');
        $article->increment('hit');
        $data['article'] = $article;

        return view('front.post', $data);
    }

    public function category(Request $request, $slug)
    {
        $category=Category::where('slug',$slug)->first() ?? abort('403', 'There is no category like this');
        $data['category']=$category ;
        $data['articles']=Article::where('category_id',$category->id)->orderBy('created_at', 'DESC')->paginate(1);

        return view('front.category',$data);
    }

    public function page(Request $request,$slug)
    {
        $page=Page::where('slug',$slug)->first() ?? abort('403', 'There is no page like this');
        $data['page']=$page;

        return view('front.page',$data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required|min:5'
        ]);

        if ($validator->fails()) {
            return redirect()->route('contact')->withErrors($validator)->withInput();
        }

        //FOR SENDING MAIL

        Mail::raw('Who Sending :'.$request->name.'</br>'.
                        'Sending from :'.$request->email.'</br>'.
                        'Subject :'.$request->subject.'</br>'.
                        'Message :'.$request->message


        ,function ($message) use ($request) {
            $message->from('ilet@blog.com','some user');
            $message->to('ismetozkan32@hotmail.com');
            $message->subject($request->name.' tarafından');
        });

        //FOR SAVE IN DATABASE

        $contact = new Contact();
        $contact->fill([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'subject'=>$request->get('subject'),
            'message'=>$request->get('message')
        ]);
        $contact->save();


        return redirect()->route('contact')->with('success','Message Has Delivered');

    }
}

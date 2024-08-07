<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class Homepage extends Controller
{
    public function __construct(){
        if(Config::find(1)->active==0){
            return redirect()->to('site-bakimda')->send();
        }
        view()->share('pages',Page::where('status',1)->orderBy('order','ASC')->get());
        view()->share('categories',Category::where('status',1)->inRandomOrder()->get());
        view()->share('config',Config::find(1));
    }

    public function index(Request $request): View
    {
        $data = [];

        $search = $request->input('search');

        $query = Article::with('getCategory')
            ->where('status', 1)
            ->whereHas('getCategory', function($query) {
                $query->where('status', 1);
            });

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('getCategory', function ($query) use ($search) {
                        $query->where('title', 'like', "%{$search}%");
                    });
            });
        }

        $data['articles'] = $query->orderBy('created_at', 'DESC')->get();

        return view('front.homepage', $data);
    }

    public function single($category, $slug)
    {
        $category = Category::where('slug', $category)->firstOrFail();
        $article = Article::where('slug', $slug)
            ->where('category_id', $category->id)
            ->firstOrFail();

        $article->increment('hit');

        $data['article'] = $article;

        return view('front.single', $data);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $data['category'] = $category;
        $data['articles'] = Article::where('category_id', $category->id)
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('front.category', $data);
    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->first() ?? abort(403, 'Böyle bir sayfa bulunamadı');
        $data['page'] = $page;

        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function post(Request $request)
    {
        $rules = [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:10',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        Mail::html(
            '<p>Mesajı Gönderen: ' . htmlspecialchars($request->name) . '</p>' .
            '<p>Mesajı Gönderen Mail: ' . htmlspecialchars($request->email) . '</p>' .
            '<p>Mesajın Konusu: ' . htmlspecialchars($request->topic) . '</p>' .
            '<p>Mesaj: ' . nl2br(htmlspecialchars($request->message)) . '</p>' .
            '<p>Mesaj Gönderilme Tarihi: ' . now() . '</p>',
            function ($message) use ($request) {
                $message->from('iletisim@blogsitesisd.com', 'Blog Sitesi SD');
                $message->to('suhan@gmail.com');
                $message->subject($request->name . ' iletişimden mesaj gönderdi');
            }
        );

        // Save the contact message to the database if needed
        // $contact = new Contact;
        // $contact->name = $request->name;
        // $contact->email = $request->email;
        // $contact->topic = $request->topic;
        // $contact->message = $request->message;
        // $contact->save();

        return redirect()->route('contact')->with('success', 'İşlem başarıyla gerçekleşti');
    }
}

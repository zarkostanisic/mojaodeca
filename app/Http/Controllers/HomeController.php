<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Magazine;
use Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $most_view = Cache::remember('most_view', 3, function() {
        //     return Product::select('id','name','price','images','used','noprice','category_id','subcategory_id')->limit(4)->orderBy('views_num','DESC')->get();
        // });

        $home_clothing = Cache::remember('home_clothing', 3, function() {
            return Product::select('id','name','price','images','used','noprice','category_id','subcategory_id')->where('category_id','=',1)->limit(4)->orderBy('views_num','DESC')->get();
        });

        $used_list = Cache::remember('used_list', 10, function() {
            return Product::select('id','name','price','noprice')->where('used','=',1)->limit(6)->orderBy('views_num','DESC')->get();
        });

        $notused_list = Cache::remember('notused_list', 10, function() {
            return Product::select('id','name','price','noprice')->where('used','=',0)->limit(6)->orderBy('views_num','DESC')->get();
        });

        $home_shoes = Cache::remember('home_shoes', 3, function() {
            return Product::select('id','name','price','images','used','noprice','category_id','subcategory_id')->where('category_id','=',2)->limit(4)->orderBy('views_num','DESC')->get();
        });

        $home_kids = Cache::remember('home_kids', 3, function() {
            return Product::select('id','name','price','images','used','noprice','category_id','subcategory_id')->where('category_id','=',4)->limit(4)->orderBy('views_num','DESC')->get();
        });

        $latest = Cache::remember('latest', 2, function() {
            return Product::select('id','name','price','images','used','noprice','category_id','subcategory_id')->limit(5)->orderBy('created_at','DESC')->get();
        });

        $aksesoar= Cache::remember('aksesoar', 3, function() {
            return Product::select('id','name','price','images','used','noprice','category_id','subcategory_id')->where('category_id','=',3)->limit(4)->orderBy('views_num','DESC')->get();
        });

        $magazin= Cache::remember('magazin', 3, function() {
            return Magazine::latest()->take(3)->get();
;
        });
       
        return view('homepage.index',compact('home_shoes','used_list','notused_list','home_clothing','home_kids','latest','aksesoar','magazin'));
    }

    public function sitemap()
    {
      // $post = Post::active()->orderBy('updated_at', 'desc')->first();
      // $podcast = Podcast::active()->orderBy('updated_at', 'desc')->first();

      // return response()->view('sitemaps.sitemap', [
      //     'post' => $post,
      //     'podcast' => $podcast,
      // ])->header('Content-Type', 'text/xml');
       return response()->view('sitemaps.sitemap')->header('Content-Type', 'text/xml');
    }

    public function partneri(Request $request)
    {
      if (\Request::is('amp/apartmani-igalo')) { 
          return view('partners.amp');
      }
      return view('partners.index');
    }
}

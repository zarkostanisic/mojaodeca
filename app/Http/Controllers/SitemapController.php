<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Magazine;
use App\Category;
use App\MagazineCategory;

class SitemapController extends Controller
{
    public function index()
	{
	  $categories = Category::all();
	  $products = Product::orderBy('updated_at', 'desc')->first();

	  return response()->view('sitemap.index', [
	      'products' => $products,
	      'categories' => $categories,
	  ])->header('Content-Type', 'text/xml');

	}
	public function categories()
	{
	    $categories = Category::all();
	    $product = Product::orderBy('updated_at', 'desc')->first();

	    return response()->view('sitemap.categories', [
	        'categories' => $categories,
	        'product' => $product,
	    ])->header('Content-Type', 'text/xml');
	}

	public function products($cat_sitemap)
	{	
		$cat_sitemap=str_replace('+', ' ', $cat_sitemap);
		$value = new Category();
		$category=$value->list()->where('name',$cat_sitemap)->first();
        if(!$category){ abort(404);}
        $cat_id=$category->id;

	    $products = Product::where('category_id', $cat_id)->orderBy('created_at', 'desc')->limit(100)->get();
	    
	    return response()->view('sitemap.products', [
	        'products' => $products,
	    ])->header('Content-Type', 'text/xml');
	}
	public function magazin()
	{	
		$categories = MagazineCategory::all();
	  	$article = Magazine::orderBy('updated_at', 'desc')->first();

	  	return response()->view('sitemap.magazin', [
	      'article' => $article,
	      'categories' => $categories,
	  	])->header('Content-Type', 'text/xml');
	}

	public function magazinArticles($cat_sitemap)
	{	
		$value = new MagazineCategory();
		$category=$value->list()->where('name',$cat_sitemap)->first();
        if(!$category){ abort(404);}
        $cat_id=$category->id;

	    $articles = Magazine::where('cat_id', $cat_id)->orderBy('created_at', 'desc')->limit(100)->get();
	    
	    return response()->view('sitemap.magazin_article', [
	        'articles' => $articles,
	    ])->header('Content-Type', 'text/xml');
	}
	public function magazinCategories()
	{
	    $categories = MagazineCategory::all();
	    $article = Magazine::orderBy('updated_at', 'desc')->first();

	    return response()->view('sitemap.magazin_categories', [
	        'categories' => $categories,
	        'article' => $article,
	    ])->header('Content-Type', 'text/xml');
	}


	

}

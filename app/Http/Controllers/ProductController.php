<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Subcategory;
use App\User;
use App\Image;
use App\Rating;
use Cache;
use Session;
use App\Http\Requests\ProductsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function uslovi(){

        return view('uslovi');

    }

     public function about(){

        return view('onama');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
   
        $product = new Product;
        $product->name = request("name");
        $product->category_id=request("category_id");
        $product->subcategory_id=request("subcategory_id");
        if (request("description"))
        {
            $product->description = request("description");
        }
        $product->price=request("price")? : 0 ;
        $product->noprice=request("noprice")? : 0 ;
        $product->gender_id=request("gender_id");
        $product->size=request("size")?: 'Nema podatka';
        $product->used=request("used");
        $product->phone=request("phone");
        $product->country_id=request("country_id");
        $product->images=request('images');
        $product->user_id=Auth::user()->id;
        $product->save();
        return redirect()->route('admin-user'); 
    }

     public function updateViewCount(Product $product,$id)
    {
         $blogKey = 'oglas_' . $id;
        // Check if blog session key exists
        // If not, update view_count and create session key
        if (!Session::has($blogKey)) {
            $product::where('id', $id)->increment('views_num');
            Session::put($blogKey, 1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,$slug,$id)
    {   


        $blogKey = 'oglas_' . $id;
        // Check if blog session key exists
        // If not, update view_count and create session key
        if (!Session::has($blogKey)) {
            $product::where('id', $id)->increment('views_num');
            Session::put($blogKey, 1);
        }
        
        $single_product=$product::with('category','gender','country','subcategory')->find($id);
        if($single_product){
            $cat_name=$single_product->category->name;
        }else{
            abort(404);
        }  

        $user = Rating::selectRaw('ROUND( AVG(rating),1) as average')
           ->where('user_id',$single_product->user_id)->first();

        $rating=($user->average) ? $user->average : '5.0';    

        $related_product = Cache::remember('related_product'.$single_product->category_id, 6, function() use ($single_product) {
            return Product::select('id','name','price','images','used','noprice')->latestByCategory($single_product->category_id)->where('id', '!=', $single_product->id)->take(6)->get();
        });


        return view('single',compact('single_product','related_product','cat_name','rating'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,$id)
    {

        $product=$product->find($id);

        return view('edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id)
    {

        $product = $product::find($id);
        $product->name = request("name");
        $product->category_id=request("category_id");
        $product->subcategory_id=request("subcategory_id");
        if (request("description"))
        {
            $product->description = request("description");
        }
        $product->price=request("price") ? request("price") : 0;
        $product->noprice=request("noprice") ? request("noprice") : 0;
        $product->gender_id=request("gender_id");
        $product->size=request("size")?: 'Nema podatka';
        $product->used=request("used");
        $product->phone=request("phone");
        $product->country_id=request("country_id");
        $product->images=request('images');
        $product->user_id=Auth::user()->id;
        if ($request->has('deleted-images')) {
            $image = new Image;
            $image->paths = json_encode($request->input('deleted-images'));
            $image->save();
        }  
        $product->save();
        return redirect()->route('admin-user'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(Auth::id() == $product->user_id){
            $image = new Image;
            $image->paths = json_encode($product->images);
            $image->save();
            $product->delete();
        }
        return redirect()->back();
    }

    public function search(Request $request, Product $product,$category_name)
    {
        $used=true;
        $cat_id=null;
        $subcategories=null;
        if ($category_name == 'polovno'){
            $used=false; 
            $request->request->add(['used'=> 1]);
        } 
        elseif ($category_name == 'novo') { 
            $used=false;
            $request->request->add(['used'=> 0]);
        }elseif ($category_name == 'pretraga') { 
            
        }else{
            $category_name=str_replace('+', ' ', $category_name);
            $value = new Category();
            $category=$value->list()->where('name',$category_name)->first();
            if(!$category){ abort(404);}
            $cat_id=$category->id;
        
            $request->request->add(['category_id'=> $cat_id]);
            $subcategories = Cache::remember('search-subcategories-'.$cat_id, 22*60, function() use ($cat_id) {
                return Subcategory::select('id','name','gender_id')->where('category_id', $cat_id)->orderBy('name', 'asc')->get();
            }); 
        }  
        
        
        $params=['category_id','subcategory_id','gender_id','used','country_id'];
        $url = request()->url();
        $queryParams = request()->query();
        //Sorting query params by key (acts by reference)
        ksort($queryParams);
        //Transforming the query array to query string
        $queryString = http_build_query($queryParams);
        $fullUrl = "{$url}?{$queryString}";
        $products= Cache::remember($fullUrl, 5 , function () use ($product,$request,$params) {
           
            $product = $product->newQuery();
            $product= $product->select('id','name','price','images','used','country_id');
            foreach ($request->all() as $key => $value) {
                if ($value == -1) {
                    continue;
                }
                if (in_array($key, $params)) {
                    $product->where($key, $request->input($key));
                }
            }
            if($request->input('order')){
                $order_val=$request->input('order');
                if($order_val == 'date') $product->latest();
                if($order_val == 'relev') $product->orderBy('views_num','DESC');
            }else{
                $product->orderBy('views_num','DESC');
            }
        
           return $product->paginate(24);
         });
        return view('list-page',compact('products','subcategories','cat_id','used','category_name'));
    }

    public function userAdmin(Product $product,Request $request)
    {
        if($request->input('id')){
            $id=$request->input('id');
        }
        

        $product = $product->newQuery();
        $product->where('user_id', Auth::id());
        if(isset($id)){
            $products=$product->where('id', $id)->paginate(20);
        }else{
            $products=$product->latest()->paginate(20);
        }

        return view('user-admin',compact('products'));

    }

    public function userProfile( Product $product, $id)
    {   
        $auth_user = Auth::id();
        $user=User::find($id);
        $user_name=$user->name;
        $user_id=$user->id;

        $user = Rating::selectRaw('ROUND( AVG(rating),1) as average')
           ->where('user_id',$user_id)->first();

        $rating=($user->average) ? $user->average : '5.0'; 

        $vote = Rating::where('user_id',$user_id)
           ->where('user_rating_id',$auth_user)->first();

        if($vote){ $vote=$vote->rating; }else{$vote='6';}

        if($auth_user == $user_id) $vote=false;
 
        $products=$product->where('user_id',$id)->latest()->with('user')->paginate(24);
        return view('user-profile',compact('products','user_id','user_name','rating','vote'));

    }
}

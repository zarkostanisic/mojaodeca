<?php

namespace App\Http\Controllers;

use App\Magazine;
use Image;
use Session;
use App\MagazineCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MagazineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $articles=Magazine::with('category')->latest()->take(4)->get();
        $secondArticles=Magazine::latest()->skip(4)->limit(6)->get();
        $latest=Magazine::with('category')->latest()->take(5)->get();
        $fitness=Magazine::with('category')->latest()->take(3)->get();
        return view('magazine.index',compact('articles','fitness','latest','secondArticles'));
    }

    public function category($cat_name)
    {
        $cat=MagazineCategory::select('id')->where('name',$cat_name)->first();

        if(!$cat){ abort(404);}

        $cat_name=ucfirst($cat_name);
   
        $articles=Magazine::latest()->where('cat_id',$cat->id)->get();

        return view('magazine.category',compact('articles','cat_name'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $magazin_categories=MagazineCategory::all();
        return view('magazine.create',compact('magazin_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'title'=> 'required|max:255',
            'body'=> 'required',
            'main_image'=> 'required'
        ));

        $magazine=new Magazine;
        $magazine->title=$request->title;
        $magazine->description=$request->description;
        $magazine->body=$request->body;
        $magazine->cat_id=$request->cat_id;

        if( $request->hasFile('main_image') ) {
            $main_image = $request->file('main_image');
            $filename = time() . '.' . $main_image->getClientOriginalExtension();

            $limage=Image::make($main_image);
            $limage->resize(680, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(null);
           
            // THUMBNAIL GENERATOR
            $simage=Image::make($main_image);
            $simage->fit(350,230)->encode(null, 90);

            Storage::disk('public')->put( 'images/blog/'.$filename, $limage);
            Storage::disk('public')->put( 'images/blog/thumbnail/'.$filename, $limage);

            $magazine->main_image =$filename;
        }
        $magazine->save();

        return redirect()->route('magazin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Magazine  $magazine
     * @return \Illuminate\Http\Response
     */
    public function show(Magazine $magazine,$id, $slug = '')
    {
        $blogKey = 'article_' . $id;
        // Check if blog session key exists
        // If not, update view_count and create session key
        if (!Session::has($blogKey)) {
            $magazine::where('id', $id)->increment('views_num');
            Session::put($blogKey, 1);
        }
        
        $article = Magazine::findOrFail($id);
        $magazin_categories=MagazineCategory::all();
        $relatedArticles=Magazine::latest()->limit(3)->get();
        $latest=Magazine::latest()->limit(3)->get();

        return view('magazine.show',compact('article','relatedArticles','latest','magazin_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Magazine  $magazine
     * @return \Illuminate\Http\Response
     */
    public function edit(Magazine $magazine,$id)
    {
        $article=$magazine::find($id);
        $magazin_categories=MagazineCategory::all();

        return view('magazine.edit',compact('article','magazin_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Magazine  $magazine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Magazine $magazine, $id)
    {
        $magazine=$magazine::find($id);

        $magazine->title=$request->title;
        $magazine->description=$request->description;
        $magazine->body=$request->body;
        $magazine->cat_id=$request->cat_id;

        if( $request->hasFile('main_image') ) {
            
            $main_image = $request->file('main_image');
            $filename = time() . '.' . $main_image->getClientOriginalExtension();

            $limage=Image::make($main_image);
            $limage->resize(680, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(null);
           
            // THUMBNAIL GENERATOR
            $simage=Image::make($main_image);
            $simage->fit(350,230)->encode(null, 90);

            Storage::disk('public')->put( 'images/blog/'.$filename, $limage);
            Storage::disk('public')->put( 'images/blog/thumbnail/'.$filename, $limage);

            $magazine->main_image =$filename;

        }

        $magazine->save();

        return redirect()->route('magazin');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Magazine  $magazine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magazine $magazine)
    {
        //
    }

     /**
     * Display the specified AMP resource.
     *
     * @param  \App\Magazine  $magazine
     * @return \Illuminate\Http\Response
     */
    public function ampshow(Magazine $magazine,$id, $slug = '')
    {
        $instagram=false;
        $blogKey = 'article_' . $id;
        // Check if blog session key exists
        // If not, update view_count and create session key
        if (!Session::has($blogKey)) {
            $magazine::where('id', $id)->increment('views_num');
            Session::put($blogKey, 1);
        }
        $non_amp="/magazin/".$id."/".$slug;

        $value = new MagazineCategory();
        $magazin_categories=$value->list();
        $article = Magazine::findOrFail($id);
        $relatedArticles=Magazine::latest()->limit(3)->get();

        $dom = new \DomDocument();
        @$dom->loadHTML(mb_convert_encoding($article->body, 'HTML-ENTITIES', 'UTF-8'));
            
       
        // INSTAGRAM CHANGE

        $iframes = $dom->getElementsByTagName('iframe'); #DOMNodeList

        $i = $iframes->length - 1;

        while($i > -1) {
            $instagram=true;
            $iframe = $iframes->item($i);
            $src= $iframe->getAttribute('src');

            $insta_array=explode('/', $src);
            $shortcode=$insta_array[4];

            $link= $dom->createElement('amp-instagram');
            $link->setAttribute('data-shortcode', $shortcode);
            $link->setAttribute('width', "400");
            $link->setAttribute('height', "400");
            $link->setAttribute('layout', 'responsive');

            $iframe->parentNode->replaceChild($link, $iframe); 
          
            $i--;
        }

        // EMPTY SCRIPT

        $scripts = $dom->getElementsByTagName('script'); #DOMNodeList
        $x = $scripts->length - 1;

        while($x > -1) {
            $script = $scripts->item($x);
            $script->parentNode->removeChild($script);
            $x--;
        }
      
        $article->body=$dom->saveHtml();
        // $article->body = $dom->saveHTML($dom->documentElement);

        return view('magazine.amp.show',compact('article','magazin_categories','non_amp','relatedArticles','instagram'));

    }
}

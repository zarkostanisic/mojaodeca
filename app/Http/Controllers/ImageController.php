<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ImageController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $year = date("Y");   
        $month = date("m");
        $day = date("d");

        if($request->hasFile('file')) {

            $id = Auth::user()->id;
            $image=$request->file('file');
            $fileName=time().uniqid(rand()).'.'.$image->getClientOriginalExtension();

            //Resize image here    
            $background = Image::canvas(500, 500);  
            $background->fill('#fff');  

            $lphoto = Image::make($image->getRealpath());
            $lphoto->orientate();
            $lphoto->resize(500, 500, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            });
            $lphoto->encode();

            $sphoto = Image::make($image->getRealpath());
            $sphoto->orientate();
            $sphoto->fit(186,180);
            $sphoto->encode(null, 90);

            $background->insert($lphoto, 'center');
            $background->encode();

            Storage::disk('public')->put( 'images/'.$year.'/'.$month."/".$day."/".$id."/".$fileName, $background);
            Storage::disk('public')->put( 'images/'.$year.'/'.$month."/".$day."/".$id.'/small-'.$fileName, $sphoto);

            return response()->json(array('path'=> 'storage/images/'.$year.'/'.$month."/".$day."/".$id."/".$fileName), 200);

        } else {
          return response()->json(false, 200);
        }
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        dd($request->all());
        die;
    }
}

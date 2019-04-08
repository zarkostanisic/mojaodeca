<?php

namespace App\Http\Controllers;
use Cache;
use App\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // return Subcategory::select('id','name')->where('category_id', $id)->orderBy('name', 'asc')->get();

        $subcategory = Cache::remember('subcategories-'.$id, 22*60, function() use ($id) {
                    return Subcategory::select('id','name')->where('category_id', $id)->orderBy('name', 'asc')->get();

        });
        // $subcategory->push($product);
        
        return $subcategory;

    }
}

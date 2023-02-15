<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryListResource;
use App\Http\Resources\CategoryProductResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(){
        $categories = Category::all()->where('parent_id',0)->where('active',1);
        return response()->json(CategoryListResource::collection($categories));
    }

    public function getSubCategory($id){
        return response()->json(new CategoryProductResource(Category::find($id)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */


    public function getCategory($id)
    {
        return response()->json(new CategoryResource(Category::find($id)));
    }


}

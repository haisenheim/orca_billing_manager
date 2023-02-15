<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ExtendedController;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all()->where('parent_id',0);
        return view('/Admin/Categories/index')->with(compact('categories'));
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
        //
        $data = $request->except('image');
        $image = $request->image;
        $data['image'] = $this->entityImgCreate($image,'categories',time().auth()->user()->id);
        $promotion = Category::create($data);
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($id)
	{
		$category = Category::find($id);
		return view('/Admin/Categories/show')->with(compact('category'));
	}


}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("managements.categories.index")->with([
            "categories"=>Category::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("managements.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request,[
            "title"=>'required|min:3'
        ]);
        //stored data
        $title=$request->title;
        Category::create([
            "title"=>$title,
            "slug"=>Str::slug($title),
        ]);
        //user redirect
        return redirect()->route("categories.index")->with([
            "success"=>"categorie ajouté avec succés."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view("managements.categories.edit")->with([
            "category"=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validation
        $this->validate($request,[
            "title"=>'required|min:3'
        ]);
        //stored data
        $title=$request->title;
        $category->update([
            "title"=>$title,
            "slug"=>Str::slug($title),
        ]);
        //user redirect
        return redirect()->route("categories.index")->with([
            "success"=>"categorie modifiée avec succés."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        //user redirect
        return redirect()->route("categories.index")->with([
            "success"=>"categorie supprimée avec succés."
        ]);
    }
}

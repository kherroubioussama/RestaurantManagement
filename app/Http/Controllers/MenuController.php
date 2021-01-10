<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("managements.menus.index")->with([
            "menus"=>Menu::paginate(4)
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
        return view("managements.menus.create")->with([
            "categories"=>Category::all()
        ]);
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
            "title"=>'required|min:3|unique:menus,title',
            "description"=>'required|min:5',
            "image"=>'required|image|mimes:jpg,png,jpeg|max:2048',
            "price"=>'required|numeric',
            "category_id"=>'required|numeric',
        ]);
        //stored data
        if($request->hasFile("image")){
            $file=$request->image;
            $imageName=time(). "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menus'),$imageName);
            $title=$request->title;
        Menu::create([
            "title"=>$title,
            "slug"=>Str::slug($title),
            "description"=>$request->description,
            "price"=>$request->price,
            "category_id"=>$request->category_id,
            "image"=>$imageName

        ]);
        //user redirect
        return redirect()->route("menus.index")->with([
            "success"=>"menu ajouté avec succés."
        ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
        return view("managements.menus.edit")->with([
            "categories"=>Category::all(),
            "menu"=>$menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //validation
        $this->validate($request,[
            "title"=>'required|min:3|unique:menus,title,'.$menu->id,
            "description"=>'required|min:5',
            "image"=>'image|mimes:jpg,png,jpeg|max:2048',
            "price"=>'required|numeric',
            "category_id"=>'required|numeric',
        ]);
        //stored data
        if($request->hasFile("image")){
            unlink(public_path('images/menus/' . $menu->image));
            $file=$request->image;
            $imageName=time(). "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menus'),$imageName);
            $title=$request->title;
        $menu->update([
            "title"=>$title,
            "slug"=>Str::slug($title),
            "description"=>$request->description,
            "price"=>$request->price,
            "category_id"=>$request->category_id,
            "image"=>$imageName

        ]);
        //user redirect
        return redirect()->route("menus.index")->with([
            "success"=>"menu modifié avec succés."
        ]);
        }else{
            $title=$request->title;
        $menu->update([
            "title"=>$title,
            "slug"=>Str::slug($title),
            "description"=>$request->description,
            "price"=>$request->price,
            "category_id"=>$request->category_id,

        ]);
        //user redirect
        return redirect()->route("menus.index")->with([
            "success"=>"menu modifié avec succés."
        ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //remove image
        unlink(public_path('images/menus/' . $menu->image));
        //
        $menu->delete();
        //user redirect
        return redirect()->route("menus.index")->with([
            "success"=>"menu supprimé avec succés."
        ]);
    }
}

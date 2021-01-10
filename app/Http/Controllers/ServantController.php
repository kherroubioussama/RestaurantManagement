<?php

namespace App\Http\Controllers;

use App\Models\Servant;
use Illuminate\Http\Request;

class ServantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("managements.serveurs.index")->with([
            "serveurs"=>Servant::paginate(5)
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
        return view("managements.serveurs.create");
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
            "name"=>'required|min:3'
        ]);
        //stored data
        $name=$request->name;
        $adress=$request->adress;
        Servant::create([
            "name"=>$name,
            "adress"=>$adress,
        ]);
        //user redirect
        return redirect()->route("serveurs.index")->with([
            "success"=>"serveur ajouté avec succés."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function show(Servant $servant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view("managements.serveurs.edit")->with([
            "serveur"=>Servant::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //validation
        $this->validate($request,[
            "name"=>'required|min:3'
        ]);
        //stored data
        $name=$request->name;
        $adress=$request->adress;
        $servant=Servant::findOrFail($id);
        $servant->update([
            "name"=>$name,
            "adress"=>$adress,
        ]);
        //user redirect
        return redirect()->route("serveurs.index")->with([
            "success"=>"serveur modifié avec succés."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $servant=Servant::findOrFail($id);
        $servant->delete();
        //user redirect
        return redirect()->route("serveurs.index")->with([
            "success"=>"serveur supprimée avec succés."
        ]);
    }
}

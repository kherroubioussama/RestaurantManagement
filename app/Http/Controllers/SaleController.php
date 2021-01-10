<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Servant;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sales=Sale::orderBy("created_at","DESC")->paginate(10);
        return view("sales.index")->with([
            "sales"=>$sales
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
       // dd($request->all());
        $this->validate($request,[
            "table_id"=>'required',
            "menu_id"=>'required',
            "servant_id"=>'required',
            "quantity"=>'required|numeric',
            "total_price"=>'required|numeric',
            "total_received"=>'required|numeric',
            "change"=>'required|numeric',
            "paiment_type"=>'required',
            "paiment_status"=>'required',
        ]);
        
        //store data
        $sale=new Sale();
        $sale->servant_id=$request->servant_id;
        $sale->quantity=$request->quantity;
        $sale->total_price=$request->total_price;
        $sale->total_received=$request->total_received;
        $sale->change=$request->change;
        $sale->paiment_type=$request->paiment_type;
        $sale->paiment_status=$request->paiment_status;
        $sale->save();
        $sale->menus()->sync($request->menu_id);
        $sale->tables()->sync($request->table_id);
        //redirect user
        return redirect()->back()->with([
            "success"=>"Paiement effectué avec succés",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //get sale tables and menus
        $sale=Sale::findOrFail($id);
        $tables=$sale->tables()->where('sale_id',$sale->id)->get();
        $menus=$sale->menus()->where('sale_id',$sale->id)->get();
        return view("sales.edit")->with([
            "tables"=>$tables,
            "menus"=>$menus,
            "sale"=>$sale,
            "serveurs"=>Servant::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //validation
       // dd($request->all());
       $this->validate($request,[
        "table_id"=>'required',
        "menu_id"=>'required',
        "servant_id"=>'required',
        "quantity"=>'required|numeric',
        "total_price"=>'required|numeric',
        "total_received"=>'required|numeric',
        "change"=>'required|numeric',
        "paiment_type"=>'required',
        "paiment_status"=>'required',
    ]);
    
    //store data
    $sale=Sale::findOrFail($id);
    $sale->servant_id=$request->servant_id;
    $sale->quantity=$request->quantity;
    $sale->total_price=$request->total_price;
    $sale->total_received=$request->total_received;
    $sale->change=$request->change;
    $sale->paiment_type=$request->paiment_type;
    $sale->paiment_status=$request->paiment_status;
    $sale->update();
    $sale->menus()->sync($request->menu_id);
    $sale->tables()->sync($request->table_id);
    //redirect user
    return redirect()->back()->with([
        "success"=>"Paiement modifié avec succés",
    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $sale=Sale::findOrFail($id);
        $sale->delete();
        return redirect()->back()->with([
            "success"=>"la vente est supprimée avec succés"
        ]);
    }
}

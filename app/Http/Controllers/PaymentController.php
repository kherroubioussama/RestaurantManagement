<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Servant;
use App\Models\Table;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function index(){
        return view("payments.index")->with([
            "categories"=>Category::all(),
            "tables"=>Table::all(),
            "serveurs"=>Servant::all()
        ]);
    }
}


<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
                <div class="container">
                    <form action="{{route("sales.store")}}" id="add-sale" method="POST">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <a href="/dashboard" class="btn btn-outline-secondary">
                                                <i class="fa fa-chevron-left"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 my-2">
                                        <h3 class="text-muted border-bottom">
                                            {{Carbon\Carbon::now()}}
                                        </h3>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <div class="form-group">
                                            <a href="{{route("sales.index")}}" class="btn btn-outline-secondary float-right">
                                                Toutes les ventes
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($tables as $table)
                                                <div class="col-md-4">
                                                    <div class="card p-2 flex flex-column justify-content-center align-items-center list-group-action mb-2">
                                                       <div class="align-self-end">
                                                        <input type="checkbox" name="table_id[]" id="table" value="{{$table->id}}">
                                                       </div>
                                                       <i class="fa fa-chair fa-3x"></i>
                                                       <span class="mt-2 text-muted font-weight-blod">
                                                            {{$table->name}}
                                                       </span>
                                                       <a href="{{route("tables.edit",$table->slug)}}" class="btn btn-sm btn-warning mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <hr>
                                                    @foreach ($table->sales as $sale)
                                                        @if ($sale->created_at >=Carbon\Carbon::today())
                                                            <div style="border : dashed pink" class="mb-2 mt-2 shadow w-100" id="{{$sale->id}}">
                                                                <div class="card">
                                                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                                        @foreach ($sale->menus()->where("sale_id",$sale->id)->get() as $menu)
                                                                            <h5 class="font-weight-bold mt-2">
                                                                                {{$menu->title}}
                                                                            </h5>
                                                                            <span class="text-muted">
                                                                                {{$menu->price}} DA
                                                                            </span>
                                                                        @endforeach
                                                                        <h5 class="font-weight-bold mt-2">
                                                                           <span class="badge badge-primary">
                                                                            Serveur : {{$sale->servant->name}}
                                                                           </span>
                                                                        </h5>
                                                                        <h5 class="font-weight-bold mt-2">
                                                                            <span class="badge badge-light">
                                                                             Qte : {{$sale->quantity}}
                                                                            </span>
                                                                         </h5>
                                                                         <h5 class="font-weight-bold mt-2">
                                                                            <span class="badge badge-light">
                                                                             Prix : {{$sale->total_price}} DA
                                                                            </span>
                                                                         </h5>
                                                                         <h5 class="font-weight-bold mt-2">
                                                                            <span class="badge badge-light">
                                                                             Total : {{$sale->total_received}} DA
                                                                            </span>
                                                                         </h5>
                                                                         <h5 class="font-weight-bold mt-2">
                                                                            <span class="badge badge-light">
                                                                             Reste : {{$sale->change}} DA
                                                                            </span>
                                                                         </h5>
                                                                         <h5 class="font-weight-bold mt-2">
                                                                            <span class="badge badge-light">
                                                                             Type de paiement : {{$sale->paiment_type ==="cash" ? "Espèce":"Carte banciare"}}
                                                                            </span>
                                                                         </h5>
                                                                         <h5 class="font-weight-bold mt-2">
                                                                            <span class="badge badge-light">
                                                                              Etat de paiement : 
                                                                             @if ($sale->paiment_status ==="paid")
                                                                                 <span class="badge badge-success">Payé</span>
                                                                            @else
                                                                            <span class="badge badge-danger">Non Payé</span>
                                                                             @endif
                                                                            </span>
                                                                         </h5>
                                                                    </div>
                                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                                        <span class="font-weight-bold">
                                                                            Restaurant XXXXXX
                                                                        </span>
                                                                        <span>
                                                                            Zeboudja,rue 105
                                                                        </span>
                                                                        <span>
                                                                            02752644
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2 d-flex justify-content-center">
                                                                <a href="{{route("sales.edit",$sale->id)}}" class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="#" target="_blank" class="btn btn-sm btn-primary"
                                                                onclick="print({{ $sale->id }})"
                                                                >
                                                                <i class="fas fa-print"></i>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    </div>
                                                    
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center mt-2">
                            <div class="col-md-12 card p-3">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    @foreach ($categories as $category)
                                        <li class="nav-item">
                                            <a href="#{{$category->slug}}" class="nav-link mr-1"
                                            id="{{$category->slug}}-tab"
                                            data-toggle="pill"
                                            role="tab"
                                            aria-controls="{{$category->slug}}"
                                            aria-selected="true"
                                            >
                                                {{$category->title}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="pills-tabcontent">
                                    @foreach ($categories as $category)
                                        <div class="tab-pane" id="{{$category->slug}}"
                                            role="tabpanel"
                                            aria-labelledby="pills-home-tab"
                                            >
                                            <div class="row">
                                                @foreach ($category->menus as $menu)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="card h100">
                                                             <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                                <div class="align-self-end">
                                                                    <input type="checkbox" name="menu_id[]" id="menu_id" value="{{$menu->id}}">
                                                                </div>
                                                                <img src="{{asset("images/menus/".$menu->image)}}" width="100" height="100" class="img-fluid rounded-circle" alt="{{$menu->title}}">
                                                                <h5 class="font-weight-bold mt-2">
                                                                    {{$menu->title}}
                                                                </h5>
                                                                <h5 class="text-muted ">
                                                                    {{$menu->price}} DA
                                                                </h5>
                                                             </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                        
                                    @endforeach
                                    <div class="row">
                                        <div class="col-md-6 mx-auto">
                                            <div class="form-group">
                                                <select name="servant_id"  class="form-control">
                                                    <option value="" selected disabled>
                                                        serveur
                                                    </option>
                                                    @foreach ($serveurs as $serveur)
                                                        <option value="{{$serveur->id}}">{{$serveur->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        QTE
                                                    </span>
                                                </div>
                                                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Qte">   
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        $
                                                    </span>
                                                </div>
                                                <input type="number" name="total_price" id="total_price" class="form-control" placeholder="Prix">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        .00
                                                    </span>
                                                </div>
                                                
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        $
                                                    </span>
                                                </div>
                                                <input type="number" name="total_received" id="total_received" class="form-control" placeholder="Total">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        .00
                                                    </span>
                                                </div>
                                                
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        $
                                                    </span>
                                                </div>
                                                <input type="number" name="change" id="change" class="form-control" placeholder="Reste">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        .00
                                                    </span>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <select name="paiment_type"  class="form-control">
                                                    <option value="" selected disabled>
                                                        Type de paiements
                                                    </option>
                                                    <option value="cash">Espèce</option>
                                                    <option value="card">Carte bancaire</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select name="paiment_status"  class="form-control">
                                                    <option value="" selected disabled>
                                                        Etat de paiements
                                                    </option>
                                                    <option value="paid">Payé</option>
                                                    <option value="unpaid">Non Payé</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button
                                                onclick="event.preventDefault();
                                                document.getElementById('add-sale').submit();
                                                "
                                                class="btn btn-primary"
                                                >
                                                    Valider
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            
        </div>
    </div>
</x-app-layout>
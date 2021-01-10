
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
                <div class="container">
                    <form action="{{route("sales.update",$sale->id)}}" id="add-sale" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <a href="/payments" class="btn btn-outline-secondary">
                                                <i class="fa fa-chevron-left"></i>
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
                                                        <input type="checkbox" checked name="table_id[]" id="table" value="{{$table->id}}">
                                                       </div>
                                                       <i class="fa fa-chair fa-3x"></i>
                                                       <span class="mt-2 text-muted font-weight-bold">
                                                            {{$table->name}}
                                                       </span>
                                                    <hr>
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
                                <div class="tab-content" id="pills-tabcontent">
                                            <div class="row">
                                                @foreach ($menus as $menu)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="card h100">
                                                             <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                                <div class="align-self-end">
                                                                    <input type="checkbox" checked name="menu_id[]" id="menu_id" value="{{$menu->id}}">
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
                                            <div class="row">
                                                <div class="col-md-6 mx-auto">
                                                    <div class="form-group">
                                                        <select name="servant_id"  class="form-control">
                                                            <option value="" selected disabled>
                                                                serveur
                                                            </option>
                                                            @foreach ($serveurs as $serveur)
                                                                <option {{$serveur->id === $sale->servant_id ? "selected":""}} value="{{$serveur->id}}">{{$serveur->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                QTE
                                                            </span>
                                                        </div>
                                                        <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Qte" value="{{$sale->quantity}}">   
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                $
                                                            </span>
                                                        </div>
                                                        <input type="number" name="total_price" id="total_price" class="form-control" placeholder="Prix" value="{{$sale->price}}">
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
                                                        <input type="number" name="total_received" id="total_received" class="form-control" placeholder="Total" value="{{$sale->total_received}}">
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
                                                        <input type="number" name="change" id="change" class="form-control" placeholder="Reste" value="{{$sale->change}}">
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
                                                            <option {{$sale->paiment_type === "cash" ? "selected":""}} value="cash">Espèce</option>
                                                            <option {{$sale->paiment_type === "card" ? "selected":""}} value="card">Carte bancaire</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="paiment_status"  class="form-control">
                                                            <option value="" selected disabled>
                                                                Etat de paiements
                                                            </option>
                                                            <option {{$sale->paiment_satatus === "paid" ? "selected":""}} value="paid">Payé</option>
                                                            <option {{$sale->paiment_satatus === "unpaid" ? "selected":""}} value="unpaid">Non Payé</option>
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
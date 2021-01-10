
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-1">
                                                <h3 class="text-secondary">
                                                    <i class="fas fa-credit-card"></i> Ventes
                                                </h3>
                                                <a href="{{route("payments")}}" class="btn btn-primary">
                                                    <i class="fas fa-plus fa-x"></i>
                                                </a>
                                            </div>
                                            <table class="table table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Tables</th>
                                                        <th>Menus</th>
                                                        <th>Serveur</th>
                                                        <th>QTE</th>
                                                        <th>Total</th>
                                                        <th>Type de paiement</th>
                                                        <th>Etat de paiement</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($sales as $sale)
                                                        <tr>
                                                            <td>
                                                                {{$sale->id}}
                                                            </td>
                                                            <td>
                                                                @foreach ($sale->tables()->where('sale_id',$sale->id)->get() as $table)
                                                                    <div class="mb-2">
                                                                        <div class="h100">
                                                                            <div class=" d-flex flex-column justify-content-center align-items-center">
                                                                                
                                                                                <div class= "p-2 flex flex-column justify-content-center align-items-center list-group-action mb-2">
                                                                                    <i class="fa fa-chair fa-x"></i>
                                                                                    <span class="mt-2 text-muted font-weight-bold">
                                                                                            {{$table->name}}
                                                                                    </span>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                    </div>
                                                                 @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach ($sale->menus()->where('sale_id',$sale->id)->get() as $menu)
                                                                    <div class="mb-2">
                                                                        <div class="h100">
                                                                            <div class=" d-flex flex-column justify-content-center align-items-center">
                                                                                
                                                                                <img src="{{asset("images/menus/".$menu->image)}}" width="100" height="100" class="img-fluid rounded-circle" alt="{{$menu->title}}">
                                                                                <span class="font-weight-bold mt-2">
                                                                                    {{$menu->title}}
                                                                                </span>
                                                                                <span class="text-muted ">
                                                                                    {{$menu->price}} DA
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                {{$sale->servant->name}}
                                                            </td>
                                                            <td>
                                                                {{$sale->quantity}}
                                                            </td>
                                                            <td>
                                                                {{$sale->total_received}} DA
                                                           </td>
                                                           <td>
                                                            {{$sale->paiment_type ==="cash" ? "Espèce":"Carte Bancaire"}}
                                                            </td>
                                                            <td>
                                                                {{$sale->paiment_status==="paid" ? "Payé":"Non Payé"}}
                                                            </td>
                                                            <td class="d-flex flex-row justify-content-center align-items-center">
                                                                <a href="{{route("sales.edit",$sale->id)}}" class="btn btn-warning mr-1">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <form id="{{$sale->id}}" action="{{route("sales.destroy",$sale->id)}}" method="POST">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                        <button class="btn btn-danger"
                                                                        onclick="event.preventDefault();
                                                                        if(confirm('voulez vous supprimer la vente {{$sale->id}} ?'))
                                                                        document.getElementById({{$sale->id}}).submit()
                                                                        "
                                                                        >
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="my-3 d-flex justify-content-center align-items-center">
                                                {{$sales->links()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @include('layouts.sidebar')
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-1">
                                                <h3 class="text-secondary">
                                                    <i class="fas fa-chair"></i> Tables
                                                </h3>
                                                <a href="{{route("tables.create")}}" class="btn btn-primary">
                                                    <i class="fas fa-plus fa-x"></i>
                                                </a>
                                            </div>
                                            <table class="table table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Nom</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tables as $table)
                                                        <tr>
                                                            <td>
                                                                {{$table->id}}
                                                            </td>
                                                            <td>
                                                                {{$table->name}}
                                                            </td>
                                                            <td>
                                                                @if ($table->status)
                                                                    <span class="badge badge-success">
                                                                        Disponible
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-danger">
                                                                        Non Disponible
                                                                    </span>
                                                                @endif
                                                                
                                                            </td>
                                                            <td class="d-flex flex-row justify-content-center align-items-center">
                                                                <a href="{{route("tables.edit",$table->slug)}}" class="btn btn-warning mr-1">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <form id="{{$table->id}}" action="{{route("tables.destroy",$table->slug)}}" method="POST">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                        <button class="btn btn-danger"
                                                                        onclick="event.preventDefault();
                                                                        if(confirm('voulez vous supprimer la categorie {{$table->name}} ?'))
                                                                        document.getElementById({{$table->id}}).submit()
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
                                                {{$tables->links()}}
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

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
                                                    <i class="fas fa-clipboard-list"></i> Menus
                                                </h3>
                                                <a href="{{route("menus.create")}}" class="btn btn-primary">
                                                    <i class="fas fa-plus fa-x"></i>
                                                </a>
                                            </div>
                                            <table class="table table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Titre</th>
                                                        <th>Description</th>
                                                        <th>Prix</th>
                                                        <th>Categorie</th>
                                                        <th>Image</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($menus as $menu)
                                                        <tr>
                                                            <td>
                                                                {{$menu->id}}
                                                            </td>
                                                            <td>
                                                                {{$menu->title}}
                                                            </td>
                                                            <td>
                                                                 {{substr($menu->description,100)}} 
                                                            </td>
                                                            <td>
                                                                {{$menu->price}} DA
                                                           </td>
                                                           <td>
                                                            {{$menu->category->title}}
                                                            </td>
                                                            <td>
                                                                <img src="{{asset("images/menus/".$menu->image)}}" alt="{{$menu->title}}" class="fluid" width="60" height="60">
                                                            </td>
                                                            <td class="d-flex flex-row justify-content-center align-items-center">
                                                                <a href="{{route("menus.edit",$menu->slug)}}" class="btn btn-warning mr-1">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <form id="{{$menu->id}}" action="{{route("menus.destroy",$menu->slug)}}" method="POST">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                        <button class="btn btn-danger"
                                                                        onclick="event.preventDefault();
                                                                        if(confirm('voulez vous supprimer le menu {{$menu->title}} ?'))
                                                                        document.getElementById({{$menu->id}}).submit()
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
                                                {{$menus->links()}}
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
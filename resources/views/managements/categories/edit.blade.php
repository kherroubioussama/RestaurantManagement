
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
                                            <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-1 mb-3 p-2">
                                                <h3 class="text-secondary">
                                                    <i class="fas fa-edit"></i> Modifier la categorie categorie: {{$category->title}}
                                                </h3>
                                            </div>
                                            <form action="{{route("categories.update",$category->slug)}}" method="POST">
                                                @csrf
                                                @method("PUT")
                                                <div class="form-group">
                                                    <input type="text" name="title" id="title" class="form-control" placeholder="Titre"  value="{{$category->title}}">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary">
                                                        Valider
                                                    </button>
                                                </div>
                                            </form>
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
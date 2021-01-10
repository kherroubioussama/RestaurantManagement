
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
                                                    <i class="fas fa-plus"></i> Ajouter un menu
                                                </h3>
                                            </div>
                                            <form action="{{route("menus.store")}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" name="title" id="title" class="form-control" placeholder="Titre">
                                                    @if($errors->has('title'))
                                                    <span class="text-danger">
                                                        {{$errors->first('title')}}
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Description"></textarea>
                                                    @if($errors->has('description'))
                                                    <span class="text-danger">
                                                        {{$errors->first('description')}}
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            $
                                                        </span>
                                                    </div>
                                                    <input type="number" name="price" id="price" class="form-control" placeholder="Prix" >
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            .00
                                                        </span>
                                                    </div>
                                                    
                                                </div>
                                                @if($errors->has('price'))
                                                    <span class="text-danger">
                                                        {{$errors->first('price')}}
                                                    </span>
                                                    @endif
                                                <div class="input-group mb-3">
                                    
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            image
                                                        </span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" name="image" id="image" class="custom-file-input" >
                                                        <label class="custom-file-label">2mg max</label>
                                                    </div>
                                                    
                                                </div>
                                                @if($errors->has('image'))
                                                    <span class="text-danger">
                                                        {{$errors->first('image')}}
                                                    </span>
                                                    @endif
                                                <div class="form-group">
                                                    <select name="category_id" class="form-control">
                                                        <option value="" selected disabled>Choisir une categorie</option>
                                                        @foreach ($categories as $category)
                                                        <option  value="{{$category->id}}">{{$category->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('category_id'))
                                                    <span class="text-danger">
                                                        {{$errors->first('category_id')}}
                                                    </span>
                                                    @endif
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
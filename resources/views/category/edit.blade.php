@extends("layouts.app")
@section("content")
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("home")}}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("category.index")}}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>Create New Category</h4>
            <hr>
            <form action="{{route("category.update",$category->id)}}" method="post">
                @csrf
                @method("put")
                <div class="row">
                    <div class="col">
                        <input type="text" name="title" value="{{old("title",$category->title)}}" class="form-control @error("title") is-invalid @enderror ">
                        @error("title")
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">Update Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends("layouts.app")
@section("content")
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("home")}}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("post.index")}}">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>Edit Post</h4>
            <hr>
            <form action="{{route("post.update",$post->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="mb-3">
                    <label class="mb-1" for="title">Post title</label>
                    <input type="text" value="{{old("title",$post->title)}}" class="form-control @error("title") is-invalid @enderror" name="title" id="title">
                    @error('title')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="mb-1" for="category">Post category</label>
                    <select type="text" class="form-select @error("category") is-invalid @enderror" name="category" id="category">
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{$category->id}}" {{$category->id==old("category",$post->category_id)?"selected":""}} >{{$category->title}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="mb-1" for="description">Post description</label>
                    <textarea rows="7" class="form-control @error("description") is-invalid @enderror" name="description" id="description">
                        {{old("description",$post->description)}}
                    </textarea>
                    @error('description')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-flex justify-content-between ">
                    <div class="">
                        <label class="form-label" for="featured_image">Image</label>
                        <input type="file" id="featured_image" name="featured_image" class="form-control @error("featured_image") is-invalid @enderror">
                        @error('featured_image')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <button class="btn btn-lg btn-primary">Update Post</button>
                </div>
                @isset($post->featured_image)
                    <img src="{{asset("storage/".$post->featured_image)}}" class="w-100 mt-3" alt="">
                @endisset
            </form>
        </div>
    </div>
@endsection

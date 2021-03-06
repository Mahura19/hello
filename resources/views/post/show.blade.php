@extends("layouts.app")
@section("content")
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("home")}}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("post.index")}}">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>{{$post->title}}</h4>
            <hr>
            <div class="mb-3">
                <span class="badge bg-secondary">{{$post->category->title}}</span>
                <span class="badge bg-secondary">{{$post->user->name}}</span>
                <span class="badge bg-secondary"><i class="bi bi-calendar"></i> {{$post->created_at->format("d M Y")}}</span>
                <span class="badge bg-secondary"><i class="bi bi-clock"></i> {{$post->created_at->format("h : i A")}}</span>
            </div>
            @isset($post->featured_image)
                <img src="{{asset("storage/".$post->featured_image)}}" class="w-100 mb-3" alt="">
            @endisset
            <p>{{$post->description}}</p>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{route("post.create")}}" class="btn btn-outline-primary">Create New Post</a>
                <a href="{{route("post.index")}}" class="btn btn-primary">All Posts</a>
            </div>
        </div>
    </div>
@endsection

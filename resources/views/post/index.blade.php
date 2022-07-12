@extends("layouts.app")
@section("content")
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("home")}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post List</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>Posts</h4>
            <hr>
            <div class="d-flex justify-content-between mb-3">
                <div class="">
                    @if(request("keyword"))
                    <span class="mb-0 me-1">Search by : "{{request("keyword")}}"</span>
                        <a href="{{route("post.index")}}"><i class="bi bi-trash text-primary"></i></a>
                        @endif
                </div>
                <form action="{{route("post.index")}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" required>
                        <button class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
                    </div>
                </form>
            </div>
            <table class="table table-hover border">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>User</th>
                    <th>Control</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td class="w-25">
                            {{$post->title}}

                        </td>
                        <td class="">
                            {{\App\Models\Category::find($post->category_id)->title}}
                        </td>
                        <td>
                            {{\App\Models\User::find($post->user_id)->name}}
                        </td>
                        <td>
                            <a href="{{route("post.show",$post->id)}}" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            @can("update",$post)
                            <a href="{{route("post.edit",$post->id)}}" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-pen"></i>
                            </a>
                            @endcan
                            @can("delete",$post)
                            <form action="{{route("post.destroy",$post->id)}}" class="d-inline-block" method="post">
                                @csrf
                                @method("delete")
                                <button class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                            @endcan
                        </td>
                        <td>
                            <p><i class="bi bi-calendar"></i> {{$post->created_at->format("d M Y")}}</p>
                            <p><i class="bi bi-clock"></i> {{$post->created_at->format("h : i A")}}</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">There is no such thing as {{request("keyword")}}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <div class=""></div>
                {{$posts->onEachSide(1)->links()}}
            </div>
        </div>
    </div>
@endsection

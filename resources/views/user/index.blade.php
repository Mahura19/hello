@extends("layouts.app")
@section("content")
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("home")}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User List</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>Users</h4>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Control</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td class="">
                            {{$user->name}}

                        </td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>
                            <a href="{{route("post.show",$user->id)}}" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            @can("update",$user)
                                <a href="{{route("post.edit",$user->id)}}" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-pen"></i>
                                </a>
                            @endcan
                            @can("delete",$user)
                                <form action="{{route("post.destroy",$user->id)}}" class="d-inline-block" method="post">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-sm btn-outline-dark">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            @endcan
                        </td>
                        <td>
                            <p><i class="bi bi-calendar"></i> {{$user->created_at->format("d M Y")}}</p>
                            <p><i class="bi bi-clock"></i> {{$user->created_at->format("h : i A")}}</p>
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
                {{$users->onEachSide(1)->links()}}
            </div>
        </div>
    </div>
@endsection

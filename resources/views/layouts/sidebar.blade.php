<div class="list-group mb-3">
    <a href="{{route('home')}}" class="list-group-item list-group-item-action">Home</a>
    <a href="{{route('test')}}" class="list-group-item list-group-item-action">Test</a>
</div>


<p class="small text-black-50 mb-1">Manage Post</p>
<div class="list-group mb-3">
    <a href="{{route('post.index')}}" class="list-group-item list-group-item-action">Post List</a>
    <a href="{{route('post.create')}}" class="list-group-item list-group-item-action">Create Post</a>
</div>

<p class="small text-black-50 mb-1">Manage Category</p>
<div class="list-group mb-3">
    <a href="{{route('category.index')}}" class="list-group-item list-group-item-action">Category List</a>
    <a href="{{route('category.create')}}" class="list-group-item list-group-item-action">Create Category</a>
</div>

@admin
<p class="small text-black-50 mb-1">Manage Users</p>
<div class="list-group mb-3">
    <a href="{{route('user.index')}}" class="list-group-item list-group-item-action">User List</a>
</div>
@endadmin

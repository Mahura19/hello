@extends("layouts.app")
@section("content")
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route("home")}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Test Page</li>
        </ol>
    </nav>
    <div class="card">
       <div class="card-body">
          San kyi tar par
       </div>
    </div>
    @endsection

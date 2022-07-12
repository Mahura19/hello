<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request("keyword"),function ($q){
            $keyword = request("keyword");
            $q->orWhere("title","like","%$keyword%")->orWhere("description","like","%$keyword%");
        })->latest("id")->paginate(10)->withQueryString();
        return view("post.index",compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,50,"........");
        $post->category_id = $request->category;
        $post->user_id = Auth::id();
        if ($request->hasFile("featured_image")){
            $newName = uniqid()."_featured_image.".$request->file("featured_image")->extension();
            $request->file("featured_image")->storeAs("public",$newName);
            $post->featured_image = $newName;
        }
        $post->save();
        return redirect()->route("post.index")->with("status","New post is created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("post.show",compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("post.edit",compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        if (Gate::denies("update",$post)){
            return abort(403,"You are not allowed to update");
        }

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,50,"........");
        $post->category_id = $request->category;
        $post->user_id = Auth::id();
        if ($request->hasFile("featured_image")){

            Storage::delete("public/".$post->featured_image);

            $newName = uniqid()."_featured_image.".$request->file("featured_image")->extension();
            $request->file("featured_image")->storeAs("public",$newName);
            $post->featured_image = $newName;
        }
        $post->update();
        return redirect()->route("post.index")->with("status","Post is updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Gate::denies("delete",$post)){
            return abort(403,"You are not allowed to delete");
        }
        if (isset($post->featured_image)){
            Storage::delete("public/".$post->featured_image);
        }

        $post->delete();
        return redirect()->route("post.index")->with("status","Post is deleted successfully");
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function all(){
        return response()->json(Post::get());
    }

    public function slug(string $slug){
        $category = Post::where('slug',$slug)->firstOrFail();
        return response()->json($category);
    }

    public function index()
    {
        return response()->json(Post::with('category')->paginate(2));
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Post::create($request->Validated()));
    }

    public function show(Post $post)
    {
        return response()->json($post);
    }

    public function update(PutRequest $request, Post $post)
    {
        return response()->json($post->update($request->validated()));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json('Delete ok');
    }

    function upload(Request $request,Post $post){
        //Validacion
        $request->validate(([
            'image'=> "required|mimes:jpg,jpeg,png,gif|max:10240"
        ]));

        //Borrar imagen anterior cuando subimos una nueva, tambien crear
        Storage::disk('public_upload')->delete("image/".$post->image);

        $data['image'] = $filename = time() .'.'. $request->image->extension();
        $request->image->move(public_path('image'),$filename);

        $post->update($data);

        return response()->json($post);
    }
}

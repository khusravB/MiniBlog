<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->id;
        $posts = Post::query()
            ->where('user_id', $user)
            ->latest('published_at')
            ->paginate(12, ['id', 'title', 'published_at']);

        return view('user.posts.index', compact('posts'));
    }

    public function create()
    {

        return view('user.posts.create');
    }

    public function store(StorePostRequest $request)
    {

        $title = $request->input('title');
        $content = $request->input('content');
        $published_time = $request->input('published_at');
        $check = $request->boolean('opub');
        //dump($check);
        //dd($title, $content, $published_time);


        /*
        $validator = validator($request->all(), [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:10000'],
        ])->validate();

        */

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:10000'],
            'published_at' => ['nullable', 'string', 'date'],
            'published' => ['nullable', 'boolean'],
        ]);

        $user = $request->user()->id;

        $post = Post::query()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published' => $validated['published'] ?? false,
            'published_at' => new Carbon($validated['published_at'] ?? null),
            'user_id' => $user,
        ]);





        //$validated = $request->validated();

        return redirect()->route('user');

    }

    public function show(Request $request, $post_id)
    {

        $post = Post::query()->findOrFail($post_id, ['id', 'title', 'content', 'published_at', 'user_id']);

        return view('user.posts.show', compact('post'));
    }

    public function edit(Request $request, $post_id)
    {
        $post = Post::query()->findOrFail($post_id);
        return view('user.posts.edit', compact('post'));
    }

    public function update(Request $request, $post_id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:10000'],
            'published_at' => ['nullable', 'string', 'date'],
            'published' => ['nullable', 'boolean'],
        ]);

        $post = Post::query()->findOrFail($post_id);



        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => $validated['published_at'],
            'published' => $validated['published'],
        ]);

        return redirect()->route('user');
    }

    public function confirm_deleting(Request $request, $post_id){
        $post = Post::query()->findOrFail($post_id);

        return view('user.posts.delete', compact('post'));
    }

    public function delete(Request $request, $post_id)
    {
        $deleted_post = Post::destroy($post_id);
        return redirect()->route('user');
    }

    public function like()
    {
        return "Лайк++";
    }


}

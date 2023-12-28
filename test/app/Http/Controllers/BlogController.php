<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        /*
        $post = Post::query()->first();
        $post->getAttribute('foo');
        $post->title;

        dd($post->isPublished());
        */

        //$posts = Post::all();

        $validated = $request->validate([
            'page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:100']
        ]);

        //Custom pagination
        /*

        $limit = $validated['limit'] ?? 12;
        $page = $validated['page'] ?? 1;


        $offset = $limit * ($page - 1);

        $posts = Post::query()->limit($limit)->offset($offset)->get(['id', 'title', 'published_at']);
        */

        $posts = Post::query()
            ->latest('published_at')
            ->oldest('id')
            ->paginate(12, ['id', 'title', 'published_at']);


        //$posts = Post::query()->get(['id', 'title', 'published_at']);




        return view('blog.index', compact('posts'));

    }

    public function show(Request $request, $post_id)
    {
        #first and firstOrFail methods
        /*
        $post = Post::query()
            ->where('user_id', 1003)
            ->oldest('published_at')
            ->firstOrFail(['id','title', 'content', 'user_id', 'published_at']);
        */

        #Добавление в кэш и получение с методом find
        /*
        $post = cache()->remember(
            key: "post.{$post_id}",
            ttl: now()->addHour(),
            callback: function () use ($post_id){
                return Post::query()->findOrFail($post_id);

            }
        );
        */

        $post = Post::query()->findOrFail($post_id, ['id', 'title', 'content', 'published_at', 'user_id']);


        return view('blog.show', compact('post'));
    }

    public function filter(Request $request){
        $search = $request->input('search');


        $posts = Post::query()->where('title', 'LIKE',"%$search%")->paginate(12);



        return view('blog.index-filter', compact('posts'));
    }

    public function like(){
        return "Поставить лайк";
    }
}

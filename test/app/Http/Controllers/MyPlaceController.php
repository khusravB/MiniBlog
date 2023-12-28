<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MyPlaceController extends Controller
{
    public function index(Request $request): string
    {
        //dd($request->user());

        //chunkById method
        /*
        Post::query()->where('user_id', 1003)->chunkById(10, function (Collection $posts){
            foreach ($posts as $post){
                $post->update(['user_id' => 1004]);

            }
        });
        */

        return "Main page";

    }
}

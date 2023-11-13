<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Exception;

class PostController extends Controller
{
    public function store(StorePostRequest $request)
    {
        try {
            $post = Post::create([
                'body' => $request->body
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

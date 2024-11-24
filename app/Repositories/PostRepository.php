<?php

namespace App\Repositories;

use App\Models\Post;
class PostRepository
{
    public function createPost($data)
    {
        return Post::create([
            'title' => $data["title"],
            'description' => $data["description"]
        ]);
    }

    public function listPost()
    {
        return Post::get();
    }

    public function updatePost($data,$post)
    {
        $post->update([
            'title' => $data["title"] ?? $post->title,
            'description' => $data["description"] ?? $post->description
        ]);
        return $post;
    }

    public function deletePost($post)
    {
        return $post->delete();
    }
}
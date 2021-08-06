<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index($id){
        
        $post =  Comment::find($id)->post->title;
        $comments =  Post::find($id)->comments;

        return response()->json(['post' => $post,'comments' => $comments]);
    }
}

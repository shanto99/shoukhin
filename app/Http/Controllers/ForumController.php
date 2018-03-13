<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Like;
use App\Dislike;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    public function get_toForum(){
        $liked_c = [];
        $disliked_c = [];
        $posts = Post::all();
        $liked_comments = DB::select('select * from likes where user_id = ?', [Auth::user()->id]);
        foreach ($liked_comments as $like_comment) {
            array_push($liked_c, $like_comment->comment_id);
        }
        $disliked_comments = DB::select('select * from dislikes where user_id = ?', [Auth::user()->id]);
        foreach ($disliked_comments as $dislike_comment) {
            array_push($disliked_c, $dislike_comment->comment_id);
        }
        return view('forum',['posts' => $posts,'liked_c'=>$liked_c, 'disliked_c'=>$disliked_c]);
    }
    public function save_post(Request $request){

        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $user = Auth::user();
        $post = new Post();
        $post->body = $request['body'];
        if($user->post()->save($post)){
            $message = 'Post successfully created!';
        }else{
            $message = 'Something went wrong while creating Post!';
        }
        return redirect()->route('forum')->with(['message',$message]);
    }
    public function do_comment(Request $request){
        $comment_body = $request['commentElement'];
        $postId = $request['postId'];
        $comment = new Comment();
        $comment->body = $comment_body;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $postId;
        $comment->save();
    }
    public function do_like($comment_id){
        $like = new like();
        $like->user_id = Auth::user()->id;
        $like->comment_id = $comment_id;
        $like->is_like = 1;
        $like->save();
        try{
            Dislike::where('user_id',Auth::user()->id)->delete();
        }
        catch(Exception $e){

        }
        return redirect()->route('forum');
    }
    public function do_dislike($comment_id){
        $dislike = new Dislike();
        $dislike->user_id = Auth::user()->id;
        $dislike->comment_id = $comment_id;
        
        $dislike->save();
        try{
            Like::where('user_id',Auth::user()->id)->delete();
        }
        catch(Exception $e){

        }
        return redirect()->route('forum');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use DB;
use Exception;

class CommentController extends Controller
{
  protected $comment;

  public function __construct(Comment $comment)
  {
    $this->comment = $comment;
    $this->middleware('auth:api')->except('all');
  }

  public function register(Request $request)
  {
    $comment = [
      "user_id"=>$request->user()->id,
      "game_id"=>$request->id,
      "comment"=>$request->comment
    ];

    try
    {
      $comment = $this->comment->create($comment);
      return response()->json($comment,200);
    }
    catch(Exception $ex)
    {
      return response($ex);
    }
  }
  public function all()
  {
    $comments = $this->comment->all();
    return response()->json($comments,200);
  }

  public function delete(Request $request)
    {
      $comment = Comment::findOrFail($request->id);
      $user = $request->user();
      if(!$comment['user_id'] == $user['id']){
        return response()->json(['msg'=>'this is not your comment'], 400);
      }
      DB::table('comment')->where('id',$comment->id)->delete();
      return response()->json([],200);
    }
}

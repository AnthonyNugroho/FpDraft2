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
}

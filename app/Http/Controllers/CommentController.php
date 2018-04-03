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
  }

  public function register(Request $request)
  {
    $comment = [
      "iduser"=>$request->iduser,
      "idgame"=>$request->idgame,
      "comment"=>$request->comment
    ];

    try
    {
      $comment = $this->comment->create($comment);
      return response('Created',201);
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

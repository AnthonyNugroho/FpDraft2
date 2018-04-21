<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GameModel;
use DB;
use Exception;


class GameController extends Controller
{
    protected $game;

    public function __construct(GameModel $game)
    {
      $this->game = $game;
    }

    public function register(Request $request)
    {
      $game = [
        "title"=>$request->title,
        "description"=>$request->description
      ];

      try
      {
        $game = $this->game->create($game);
        return response()->json($game,200);
      }
      catch(Exception $ex)
      {
        return response($ex);
      }
    }

    public function getComment($id)
    {
    $game = GameModel::findOrFail($id);
    $game->comment;
    return $game;
    }

    public function find($id)
    {
      $game = $this->game->findOrFail($id);
      return $game;
    }

    public function all()
    {
      $games = $this->game->all();
      return response()->json($games,200);
    }

    public function delete($id)
      {
        DB::table('game')->where('id',$id)->delete();
        return response()->json([],200);
      }

    public function update(Request $request, $id)
    {
    $game = [
      "title" => $request->title,
      "description" => $request->description
    ];
      try
        {
          $this->game->findOrFail($id)->update($game);
          return response()->json([], 201);
        }
        catch(Exception $ex)
      {
      return response ($ex);
      }
    }
}

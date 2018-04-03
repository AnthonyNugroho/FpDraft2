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
        return response('Created',201);
      }
      catch(Exception $ex)
      {
        return response($ex);
      }
    }

    public function find($title)
    {
      $game = $this->game->find($title);
      return $game;
    }

    public function all()
    {
      $games = $this->game->all();
      return response()->json($games,200);
    }

    public function delete($title)
      {
        DB::table('game')->where('title',$title)->delete();
        return response('Deleted',201);
      }

    public function update(Request $request, $tile)
    {
    $user = [
      "title" => $request->title,
      "description" => $request->description
    ];
      try
        {
          $this->game->where('title',$title)->update($game);
          return response ('Updated', 201);
        }
        catch(Exception $ex)
      {
      return response ($ex);
      }
    }
}

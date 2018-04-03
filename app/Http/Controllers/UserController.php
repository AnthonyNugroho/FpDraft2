<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;
use DB;
use Exception;

class UserController extends Controller
{
  protected  $user;

  public function __construct(UserModel $user)
  {
    $this->user= $user;
  }

  public function register(Request $request)
  {
    $user = [
      "username" =>$request->username,
      "password" => md5($request->password)
    ];

    try
    {
      $user = $this->user->create($user);
      return response('created',201);
    }
    catch(Exception $ex)
    {
      return response ($ex,400);
    }
  }

  public function find($username)
  {
    $user = $this->user->find($username);
    return $user;
  }

  public function all()
  {
    $users = $this->user->all();
    return response()->json($users,200);
  }

  public function delete($username)
    {
      DB::table('user')->where('username',$username)->delete();
      return response('Deleted',201);
    }

  public function update(Request $request, $username)
  {
  $user = [
    "username" => $request->username,
    "password" => md5($request->password)
  ];
    try
      {
        $this->user->where('username',$username)->update($user);
        return response ('Updated', 201);
      }
      catch(Exception $ex)
    {
    return response ($ex);
    }
  }

}

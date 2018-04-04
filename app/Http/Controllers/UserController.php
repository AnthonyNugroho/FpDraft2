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
      "name" =>$request->name,
      "email" =>$request->email,
      "password" => md5($request->password)
    ];

    try
    {
      $user = $this->user->create($user);
      return response('created',200);
    }
    catch(Exception $ex)
    {
      return response ($ex,400);
    }
  }

  public function find($name)
  {
    $user = $this->user->where('name',$name)->get();
    return $user;
  }

  public function getComment($id)
  {
  $users = UserModel::findOrFail($id);
  $users->comment;
  return $users;
  }

  public function all()
  {
    $users = $this->user->all();
    return response()->json($users,200);
  }

  public function delete($name)
    {
      DB::table('user')->where('name',$name)->delete();
      return response('Deleted',200);
    }

  public function update(Request $request, $email)
  {
  $user = [
    "name" => $request->name,
    "email" => $request->email,
    "password" => md5($request->password)
  ];
    try
      {
        $this->user->where('email',$email)->update($user);
        return response ('Updated', 200);
      }
      catch(Exception $ex)
    {
    return response ($ex);
    }
  }

}

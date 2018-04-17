<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

  public function create(array $data)
  {
      return User::create([
          'username'=>$data['username'],
          'name' => $data['name'],
          'email' => $data['email'],
          'password' => Hash::make($data['password']),
      ]);
  }
  public function find($username)
  {
    $user = $this->user->where('username',$username)->get();
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
      DB::table('users')->where('name',$name)->delete();
      return response('Deleted',200);
    }

  public function update(Request $request, $email)
  {
  $user = [
    "name" => $request->name,
    "email" => $request->email,
    "password" => bcrypt($request->input('password')),
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

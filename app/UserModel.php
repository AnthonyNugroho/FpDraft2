<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\UserModel as Authenticatable;

class UserModel extends Model
{
  public $timestamps = false;
  protected $table = 'users';
  protected $fillable = ['name','email','password'];
  protected $guarded = [];

  public function comment()
  {
      return $this->hasMany('App\Comment', 'iduser');
  }
  use Notifiable;


   public function getJWTIdentifier()
   {
       return $this->getKey();
   }


   public function getJWTCustomClaims()
   {
       return [];
   }
}

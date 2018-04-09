<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements JWTSubject
{
  public $timestamps = false;
  protected $table = 'users';
  protected $fillable = ['name','email','password','is_verified'];
  protected $guarded = [];
  protected $hidden = [];

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

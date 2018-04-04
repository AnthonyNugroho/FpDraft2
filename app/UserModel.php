<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
  public $timestamps = false;
  protected $table = 'user';
  protected $fillable = ['name','email','password'];
  protected $guarded = [];

  public function comment()
  {
      return $this->hasMany('App\Comment', 'iduser');
  }
}

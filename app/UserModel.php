<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
  public $timestamps = false;
  protected $table = 'user';
  protected $fillable = ['username','password'];
  protected $guarded = [];
}

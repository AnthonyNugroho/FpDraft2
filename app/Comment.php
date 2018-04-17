<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public $timestamps =false;
  protected $table ='comment';
  protected $fillable = ['user_id','game_id','comment'];
  protected $guarded =[];
}

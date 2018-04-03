<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public $timestamps =false;
  protected $table ='comment';
  protected $fillable = ['iduser','idgame','comment'];
  protected $guarded =[];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameModel extends Model
{
    public $timestamps =false;
    protected $table ='game';
    protected $fillable = ['title','idcomment','description'];
    protected $guarded =[];
}

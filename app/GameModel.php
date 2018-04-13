<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameModel extends Model
{


    public $timestamps =false;
    protected $table ='game';
    protected $fillable = ['title','description'];
    protected $guarded =[];
    protected $hidden = [];

    public function comment()
    {
        return $this->hasMany('App\Comment', 'idgame');
    }

}

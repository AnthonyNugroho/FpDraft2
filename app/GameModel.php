<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameModel extends Model
{
    public $timestamps =false;
    protected $table ='game';
    protected $fillable = ['title','title','description'];
    protected $guarded =[];

    public function comment()
    {
        return $this->hasMany('App\Comment', 'idgame');
    }

}

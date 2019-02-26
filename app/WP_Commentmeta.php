<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WP_Commentmeta extends Model
{
    protected $table = 'wp_commentmeta';

    public function commentario(){

    	return $this->hasMany('App\WP_Comentario','comment_id', 'comment_ID'); 
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WP_Users extends Model
{
    protected $table = 'wp_users';

	public function comentarios(){

    	return $this->hasMany('App\WP_Comentario','user_id', 'ID'); 
    }

}

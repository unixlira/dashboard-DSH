<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WP_Posts extends Model
{
    protected $table = 'wp_posts'; //definindo a tabela do BD que a classe vai gerenciar

    public function comentarios(){

    	return $this->hasMany('App\WP_Comentario'); 
    }

    public function metacomentarios(){

    	return $this->hasMany('App\WP_Commentmeta'); 
    }
}

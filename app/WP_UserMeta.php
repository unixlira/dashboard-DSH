<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WP_UserMeta extends Model
{
    protected $table = 'wp_usermeta'; //definindo a tabela do BD que a classe vai gerenciar

    public $timestamps = true; //desabilitando controle de data e hora de manipulação dos registros
}

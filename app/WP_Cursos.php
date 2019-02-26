<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WP_Cursos extends Model
{
    protected $table = 'wp_posts'; //definindo a tabela do BD que a classe vai gerenciar

    public $timestamps = true; //desabilitando controle de data e hora de manipulação dos registros
}

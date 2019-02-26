<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios'; //definindo a tabela do BD que a classe vai gerenciar

    public $timestamps = true; //desabilitando controle de data e hora de manipulação dos registros

    //necessário para descriminar quais campos serao aceitos q sejam add em massa, sem descricao individual:
    protected $fillable = array('nome', 'email', 'senha', 'telefone', 'endereco', 'cidade', 'permissao', 'ativo', 'foto', 'notas');


	//relacionamentos
	public function cnpj_block(){ //relacao usuarios->cnpjs_block
    	return $this->hasMany('App\Cnpj_block','id_usuario', 'id'); //informando o Model q existe uma relacao do produto com a categoria
    	//hasMany indica q a cardinalidade é de 0:N (cada usuario pertence bloqueia varias categorias)
    }

	public function participantes(){ //relacao usuarios->cnpjs_block
    	return $this->hasMany('App\Participantes','id_usuario', 'id'); //informando o Model q existe uma relacao do produto com a categoria
    	//hasMany indica q a cardinalidade é de 0:N (cada usuario pertence bloqueia varias categorias)
    }

/*
    public function participantes_block(){ //relacao usuarios participantes_block
    	return $this->hasMany('App\Participantes_block','id_usuario', 'id'); //informando o Model q existe uma relacao do produto com a categoria
    	//hasMany indica q a cardinalidade é de 0:N (cada usuario pertence bloqueia varias categorias)
    }
*/
}

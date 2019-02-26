<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracoesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'configuracoes';

    /**
     * Run the migrations.
     * @table configuracoes
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('id_usuario')->nullable()->default(null);
            $table->char('ativar_notificacoes', 1)->nullable()->default(null);
            $table->char('liberacao_sup_99_spins', 1)->nullable()->default(null);
            $table->char('liberacao_cupom_100', 1)->nullable()->default(null);
            $table->char('liberacao_cupom_200', 1)->nullable()->default(null);
            $table->char('liberacao_cupom_500', 1)->nullable()->default(null);
            $table->char('edicoes_usuarios', 1)->nullable()->default(null);
            $table->char('tentativa_resgate_cupom_utilizado', 1)->nullable()->default(null);
            $table->char('tentativa_cadastro_cnpj_block', 1)->nullable()->default(null);
            $table->char('cpf_cnpj_mais_500_cupons', 1)->nullable()->default(null);
            $table->char('cpf_cnpj_mais_2_premiacoes_dia', 1)->nullable()->default(null);

            $table->index(["id_usuario"], 'fk_configuracoes_usuario');


            $table->foreign('id_usuario', 'fk_configuracoes_usuario')
                ->references('id')->on('usuarios')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}

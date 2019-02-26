<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacoesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'notificacoes';

    /**
     * Run the migrations.
     * @table notificacoes
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
            $table->string('ocorrencia')->nullable()->default(null);
            $table->timestamp('data_ocorrencia')->nullable()->default(null);
            $table->timestamp('data_visualizacao')->nullable()->default(null);

            $table->index(["id_usuario"], 'fk_notificacoes_usuario');


            $table->foreign('id_usuario', 'fk_notificacoes_usuario')
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

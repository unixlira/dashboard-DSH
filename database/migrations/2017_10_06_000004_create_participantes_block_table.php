<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantesBlockTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'participantes_block';

    /**
     * Run the migrations.
     * @table participantes_block
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
            $table->unsignedInteger('id_participante')->nullable()->default(null);
            $table->char('habilitado', 1)->nullable()->default(null);
            $table->timestamp('data_bloqueio')->nullable()->default(null);

            $table->index(["id_usuario"], 'fk_usuarios_block');

            $table->index(["id_participante"], 'fk_participantes_block');


            $table->foreign('id_participante', 'fk_participantes_block')
                ->references('id')->on('participantes')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_usuario', 'fk_usuarios_block')
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

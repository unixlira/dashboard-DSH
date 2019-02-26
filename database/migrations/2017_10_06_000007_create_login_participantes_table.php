<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginParticipantesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'login_participantes';

    /**
     * Run the migrations.
     * @table login_participantes
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('id_participante')->nullable()->default(null);
            $table->string('cpf_cnpj', 20)->nullable()->default(null);
            $table->string('senha', 200)->nullable()->default(null);
            $table->char('habilitado', 1)->nullable()->default(null);

            $table->index(["id_participante"], 'fk_login_participante');


            $table->foreign('id_participante', 'fk_login_participante')
                ->references('id')->on('participantes')
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

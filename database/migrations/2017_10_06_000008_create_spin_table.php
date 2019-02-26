<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpinTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'spin';

    /**
     * Run the migrations.
     * @table spin
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
            $table->string('nota_fiscal')->nullable()->default(null);
            $table->integer('qtde_spins')->nullable()->default(null);
            $table->date('data_emissao')->nullable()->default(null);
            $table->string('status_spin', 30)->nullable()->default(null);
            $table->integer('spins_utilizados')->nullable()->default(null);
            $table->integer('saldo_spins')->nullable()->default(null);

            $table->index(["id_participante"], 'fk_spin_participante');


            $table->foreign('id_participante', 'fk_spin_participante')
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

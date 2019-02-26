<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCupomTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'cupom';

    /**
     * Run the migrations.
     * @table cupom
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
            $table->string('nota_fiscal', 200)->nullable()->default(null);
            $table->string('codigo', 100)->nullable()->default(null);
            $table->decimal('valor', 10, 2)->nullable()->default(null);
            $table->string('status_cupom', 30)->nullable()->default(null);
            $table->dateTime('data_liberacao')->nullable()->default(null);
            $table->dateTime('data_expiracao')->nullable()->default(null);

            $table->index(["id_participante"], 'fk_cupom_participante');


            $table->foreign('id_participante', 'fk_cupom_participante')
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

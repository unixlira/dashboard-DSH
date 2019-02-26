<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'usuarios';

    /**
     * Run the migrations.
     * @table usuarios
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nome')->nullable()->default(null);
            $table->string('email', 100)->nullable()->default(null);
            $table->string('senha', 200)->nullable()->default(null);
            $table->string('telefone', 20)->nullable()->default(null);
            $table->string('endereco')->nullable()->default(null);
            $table->string('cidade')->nullable()->default(null);
            $table->char('permissao', 1)->nullable()->default(null);
            $table->char('ativo', 1)->nullable()->default(null);
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

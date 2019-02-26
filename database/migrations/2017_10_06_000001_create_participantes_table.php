<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'participantes';

    /**
     * Run the migrations.
     * @table participantes
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nome_razao_social')->nullable()->default(null);
            $table->string('cpf_cnpj', 20)->nullable()->default(null);
            $table->string('email', 100)->nullable()->default(null);
            $table->string('telefone', 20)->nullable()->default(null);
            $table->char('sexo', 1)->nullable()->default(null);
            $table->string('device_id', 50)->nullable()->default(null);
            $table->string('mac_address', 20)->nullable()->default(null);
            $table->timestamp('data_cadastro')->nullable()->default(null);
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

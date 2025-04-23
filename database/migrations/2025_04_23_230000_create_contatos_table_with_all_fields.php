<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('contatos')) {
            Schema::drop('contatos');
        }

        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->text('mensagem')->nullable();
            $table->unsignedBigInteger('tipo_contato_id')->nullable();
            $table->boolean('lido')->default(false);
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->timestamps();
            $table->foreign('tipo_contato_id')
                  ->references('id')
                  ->on('tipo_contatos')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};

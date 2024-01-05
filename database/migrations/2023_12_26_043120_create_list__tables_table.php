<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list__tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('project__tables')->onUpdate('cascade')
            ->onDelete('cascade');;
            $table->string('list');
            $table->string('desc');
            $table->integer('score');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list__tables');
    }
};

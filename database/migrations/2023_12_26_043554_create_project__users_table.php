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
        Schema::create('project_user', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained('project__tables')->onUpdate('cascade')
            ->onDelete('cascade');;
            $table->foreignId('list_id')->constrained('list__tables')->onUpdate('cascade')
            ->onDelete('cascade');;
            $table->boolean('status');
            $table->foreignUuid('user_id')->references('uuid')->on('trainees')->unique()->onUpdate('cascade')
            ->onDelete('cascade');;
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
        Schema::dropIfExists('project__users');
    }
};

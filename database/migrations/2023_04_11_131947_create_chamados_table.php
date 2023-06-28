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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('text');
            $table->enum('status', ['pending', 'on_going', 'done'])->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('done_by')->nullable();
            $table->timestamp('done_at')->nullable();
            $table->timestamps();
            $table->foreign('created_by')
              ->references('id')
              ->on('users')
              ->onDelete('cascade')
              ->onUpdate('cascade');
            $table->foreign('done_by')
              ->references('id')
              ->on('users')
              ->onDelete('cascade')
              ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};

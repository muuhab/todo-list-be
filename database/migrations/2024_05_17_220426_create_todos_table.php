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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            // $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('completed')->default(false);
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->softDeletes('deleted_at', precision: 0);
            $table->timestamps();
        });

        Schema::create('todo_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('todo_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->string('name');
            $table->softDeletes('deleted_at', precision: 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
        Schema::dropIfExists('todo_attachments');
    }
};

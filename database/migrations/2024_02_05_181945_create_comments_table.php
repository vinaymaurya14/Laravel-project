<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // id: unsigned big int, PK, NotNull
            $table->unsignedBigInteger('task_id'); // task_id: unsigned big int, FK (tasks.id), NotNull
            $table->text('comment'); // comment: text, NotNull
            $table->timestamps(); // created_at & updated_at: datetime, nullable

            // Foreign key constraint
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

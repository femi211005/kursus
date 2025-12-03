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
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Foreign key for users table
            $table->unsignedBigInteger('course_id'); // Foreign key for courses table
            $table->unsignedBigInteger('content_id'); // Foreign key for contents table
            $table->boolean('is_done')->default(false); // To mark content as done
            $table->timestamp('marked_at')->nullable(); // Timestamp when the content is marked as done
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * Pivot table for Users (students) in a ClassSession
         */
        Schema::create('classsession_student', function (Blueprint $table) {
            $table->foreignId('class_sessions')->constrained()->cascadeOnDelete();
            // Student IDs
            $table->foreignId('users_id')->constrained()->cascadeOnDelete();
            $table->primary(['class_sessions', 'users_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classsession_student');
    }
};

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
        //Deletes the package_course pivot table
        Schema::dropIfExists('package_course');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('package_course', function (Blueprint $table) {
            $table->foreignId('packages_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->primary(['packages_id', 'course_id']);
        });
    }
};

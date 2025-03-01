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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // A Course has one Package
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->string('national_code');
            $table->string('aqf_level');
            $table->string('title');
            $table->string('tga_status');
            $table->string('status_code');
            $table->string('nominal_hours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

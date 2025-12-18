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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->string('personal_information');
            $table->string('property_information');
            $table->string('general_enquiry');
            $table->string('premium_enquiry');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};

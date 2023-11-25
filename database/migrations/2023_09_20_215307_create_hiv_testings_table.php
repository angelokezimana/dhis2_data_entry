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
        Schema::create('hiv_testings', function (Blueprint $table) {
            $table->id();
            $table->uuid('patient_id');
            $table->string('data_element_id', 100);
            $table->string('category_option_combo_id', 100);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('data_element_id')->references('id')->on('data_elements')->onDelete('cascade');
            $table->foreign('category_option_combo_id')->references('id')->on('category_option_combos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiv_testings');
    }
};

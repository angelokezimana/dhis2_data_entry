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
        Schema::create('data_set_organisation', function (Blueprint $table) {
            $table->id();
            $table->string('org_id', 100);
            $table->string('data_set_id', 100);

            $table->foreign('org_id')->references('id')->on('organisation_units')->onDelete('cascade');
            $table->foreign('data_set_id')->references('id')->on('data_sets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_set_organisation');
    }
};

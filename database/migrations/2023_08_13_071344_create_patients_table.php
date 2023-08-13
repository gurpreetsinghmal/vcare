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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('husbandName')->nullable();
            $table->string('village')->nullable();
            $table->string('mobile')->nullable();
            $table->string('currDeliveryCount')->nullable();
            $table->string('prevChildAge')->nullable();
            $table->string('previousDeliveryType')->nullable();
            $table->string('sexPreviousChild')->nullable();
            $table->string('tt1Switch')->nullable();
            $table->string('tt2Switch')->nullable();
            $table->string('ttbswitch')->nullable();
            $table->string('counsDiet')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};

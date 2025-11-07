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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('address')->index();
            $table->string('oib', 13);
            $table->string('representer');
            $table->integer('connection_tag');
            $table->string('type_of_partner')->nullable()->default("Contract");
            $table->string('phone');
            $table->string('email');
            $table->string('seller')->nullable()->default("Ofir");
            $table->string('activities')->nullable()->default("Odoo");
            $table->string('city')->index();
            $table->string('country')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

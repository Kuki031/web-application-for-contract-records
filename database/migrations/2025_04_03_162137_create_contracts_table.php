<?php

use App\Models\Client;
use App\Models\Price;
use App\Models\Service;
use App\Models\User;
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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->date('starting_date')->nullable()->index();
            $table->date('expiration_date')->nullable()->index();
            $table->string('template_name');
            $table->foreignIdFor(Price::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Service::class)->nullable()->constrained()->nullOnDelete();
            $table->string('word_link')->default("no link");
            $table->foreignIdFor(User::class)->nullable();
            $table->date('signing_date');
            $table->longText('note')->nullable();
            $table->foreignIdFor(Client::class)->index()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('pdf_link')->nullable();
            $table->boolean('is_active')->nullable()->default(0);
            $table->boolean('is_visible_to_all')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};

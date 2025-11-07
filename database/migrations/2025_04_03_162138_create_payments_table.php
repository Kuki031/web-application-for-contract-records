<?php

use App\Models\Client;
use App\Models\Contract;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date("month_year")->nullable();
            $table->string('status')->default('not sent');
            $table->text("note")->nullable();
            $table->foreignIdFor(Contract::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('sent_date')->nullable();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

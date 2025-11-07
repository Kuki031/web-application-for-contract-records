<?php

use App\Enums\Domain;
use App\Models\Client;
use App\Models\Hosting;
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
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->enum('type', array_map(fn($case) => $case->value, Domain::cases()))->index();
            $table->string('registrar')->index();
            $table->string('user')->index();
            $table->boolean('has_access')->default(false);
            $table->boolean('is_redirected')->default(false);
            $table->string('is_redirected_where')->nullable();
            $table->date('expires_at')->nullable();
            $table->foreignIdFor(Client::class)->index()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};

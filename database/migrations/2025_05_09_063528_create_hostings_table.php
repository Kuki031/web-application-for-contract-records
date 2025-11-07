
<?php

use App\Models\Client;
use App\Models\Domain;
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
        Schema::create('hostings', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Client::class)->index()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("package_name")->index();
            $table->string("package_description");
            $table->string("price");
            $table->date("expiration_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostings');
    }
};

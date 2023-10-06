<?php

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
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('invoice_id', 6)->unique();
            $table->unsignedTinyInteger('status');
            $table->string('address', 50)->nullable();
            $table->string('city', 25)->nullable();
            $table->string('postcode', 25)->nullable();
            $table->string('country', 25)->nullable();
            $table->string('client_name', 25)->nullable();
            $table->string('client_email', 50)->nullable();
            $table->string('client_address', 50)->nullable();
            $table->string('client_city', 25)->nullable();
            $table->string('client_postcode', 25)->nullable();
            $table->string('client_country', 25)->nullable();
            $table->timestamp('invoice_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

<?php

use App\Enums\InvoiceStatus;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('client_name', 25);
            $table->string('client_email', 50);
            $table->string('description', 50);
            $table->unsignedTinyInteger('payment_terms');
            $table->unsignedTinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};

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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string("orderNumber");
            $table->integer("type");
            $table->float("amount");
            $table->float("amountCustomer")->nullable();
            $table->string("currency");
            $table->string("provider_reference")->nullable();
            $table->boolean("status")->default(0);
            #$table->softDeletes(); // if you use softDelete ! 
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

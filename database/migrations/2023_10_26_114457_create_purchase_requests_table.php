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
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->text('note')->nullable();
            $table->foreignId('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->enum('status', ['Approved', 'Pending', 'Rejected']);
            $table->foreignId('tax_id')->references('id')->on('taxes')->onDelete('cascade')->nullable();
            $table->integer('price_total')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_requests');
    }
};

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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->index();
            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->tinyInteger('template')->default(1);
            $table->string('number');
            $table->string('year');
            $table->date('completed')->nullable();
            $table->tinyInteger('status')->default(1); // 1 - Nou, 2 - Completat, 3 - Validat, 4 - Anulat
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};

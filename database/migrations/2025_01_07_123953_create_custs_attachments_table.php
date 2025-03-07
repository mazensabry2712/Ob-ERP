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
        Schema::create('custs_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name', 999);
            $table->string('cust_number', 50);
            $table->string('Created_by', 999);
            $table->foreignId('cust_id')->nullable()->constrained('custs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custs_attachments');
    }
};

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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->Integer('client_id')->unsigned()->index();
            $table->Integer('user_id')->unsigned()->index();
            $table->Integer('handleuser_id')->unsigned()->index();
            $table->datetime('makeitem_at')->index();
            $table->datetime('handle_at')->index();
            $table->string('name', 500)->index();
            $table->string('remark', 500)->nullable();
            $table->tinyinteger('status')->nullable();
            $table->datetime('comp_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

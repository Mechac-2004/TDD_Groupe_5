<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->decimal('note', 4, 2)->change();
        });
    }
    
    
    
    /**
     * Reverse the migrations.
     */
    
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->decimal('note', 2, 2)->change();
        });
    }
};

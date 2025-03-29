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
        Schema::create('tbl_user1', function (Blueprint $table) {
            $table->id(); // This automatically sets 'id' as PRIMARY KEY
            $table->string('username')->unique(); // Use unique() instead of primary()
        });
        

        Schema::table('tbl_user1', function (Blueprint $table) {
            $table->id()->change(); // Makes 'id' AUTO_INCREMENT & PRIMARY KEY
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_user1', function (Blueprint $table) {
            $table->integer('id')->change(); // Reverts the change if rolled back
        });
    }
};

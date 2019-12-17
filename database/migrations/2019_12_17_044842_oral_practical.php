<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OralPractical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("2017_d7b_oral_prac",function(Blueprint $table){
        $table->integer('rollno')->unique();
        $table->string('full_name')->primary();
        $table->Integer('AOA_marks')->nullable(false);
        $table->Integer('COA_marks')->nullable(false);
        $table->Integer('CG_marks')->nullable(false);
        $table->Integer('OS_marks')->nullable(false);
        $table->Integer('open_source_marks')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

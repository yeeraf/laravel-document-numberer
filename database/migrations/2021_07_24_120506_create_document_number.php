<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentNumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_numbers', function (Blueprint $table) {
            $table->id();
            $table->string("prefix");
            $table->string("suffix");
            $table->integer("pad_length");
            $table->string("pad_string");
            $table->string("pad_type")->nullable();
            $table->unsignedInteger("current_number");
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
        Schema::dropIfExists('document_numbers');
    }
}

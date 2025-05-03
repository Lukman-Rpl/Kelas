<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('ulasan', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->text('message');
        $table->unsignedTinyInteger('rating'); // rating dari 1 - 5
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('ulasan');
}

};

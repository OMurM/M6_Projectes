<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePingsTable extends Migration
{
    public function up()
    {
        Schema::create('pings', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ip_dominio');
            $table->boolean('estado')->default(false);
            $table->integer('latency')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponseUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_urls', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('status_code')->nullable(true);
            $table->text('response_http')->nullable(true);
            $table->binary('html')->nullable(true);
            $table->unsignedBigInteger('url_id');
            $table->foreign('url_id')->references('id')->on('urls')->onDelete('cascade');
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
        Schema::dropIfExists('response_urls');
    }
}

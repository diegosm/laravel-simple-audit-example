<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string( 'method')->nullable();
            $table->string( 'path')->nullable();
            $table->text('query')->nullable();
            $table->string('userAgent')->nullable();
            $table->string('ip', 20)->nullable();
            $table->string( 'device')->nullable();
            $table->string( 'platform')->nullable();
            $table->string( 'browser')->nullable();
            $table->boolean('isDesktop')->nullable()->default(false);
            $table->boolean('isMobile')->nullable()->default(false);
            $table->boolean('isPhone')->nullable()->default(false);
            $table->boolean('isTablet')->nullable()->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audits');
    }
}

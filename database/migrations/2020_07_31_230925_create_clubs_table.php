<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->string('phone', 50)->nullable()->default(null);
            $table->string('email', 255)->nullable()->default(null);
            $table->string('city', 100)->nullable()->default(null);
            $table->string('country_code', 2)->nullable()->default(null);
            $table->dateTime('approved_at')->nullable()->default(null);
            $table->dateTime('activated_at')->nullable()->default(null);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('owner_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('owner_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubs');
    }
}

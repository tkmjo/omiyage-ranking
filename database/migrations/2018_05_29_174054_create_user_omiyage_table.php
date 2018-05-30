<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOmiyageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_omiyage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('omiyage_id')->unsigned()->index();
            $table->timestamps();
            
            // 外部キー
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('omiyage_id')->references('id')->on('omiyages')->onDelete('cascade');
            
            // user_idとomiyage_idの組み合わせの重複を許さない
            $table->unique(['user_id', 'omiyage_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_omiyage');
    }
}

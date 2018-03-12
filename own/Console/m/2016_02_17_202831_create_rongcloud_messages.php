<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRongcloudMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zero_rongcloud_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fromUserId');
            $table->integer('toUserId');
            $table->string('objectName');
            $table->string('content');
            $table->integer('timestamp');
            $table->string('channelType');
            $table->string('msgTimestamp');
            $table->string('msgUID');
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
        Schema::drop('zero_rongcloud_messages');
    }
}

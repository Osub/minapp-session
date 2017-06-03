<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinappInfoSessionTable extends Migration
{
    /**
     * run migratios.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appinfos', function(Blueprint $table){
            $table->increments('id');
            $table->string('appid',200)->unique()->comment('小程序的appid');
            $table->string('secret',300);
            $table->integer('login_duration',11)->default(30)->comment('登录有效期');
            $table->integer('session_duration',11)->default(2592000)->comment('session有效期');
            $table->string('ip',50)->default('0.0.0.0');
            $table->softDeletes();
            $table->timestamps();
            $table->primary(['id','appid']);
        });
        Schema::create('sessioninfos', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->comment('登录小程序的用户id');
            $table->string('skey',100);
            $table->string('openid',100);
            $table->string('session_key',100);
            $table->string('user_info',2048);
            $table->dateTime('last_visit');
            $table->softDeletes();
            $table->timestamps();
            $table->primary('id');
            $table->index(['user_id','skey'], 'auth');
            $table->index(['openid','session_key'], 'weixin');
        });
    }

    /**
     * reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('appinfos');
        Schema::drop('sessioninfos');
    }
}
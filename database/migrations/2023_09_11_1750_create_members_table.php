<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('blaogs')){
            Schema::create('members', function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->string('name_sei',255);
                $table->string('name_mei',255);
                $table->string('nickname',255);
                $table->integer('gender');
                $table->string('password',255);
                $table->string('email',255);
                $table->integer('auth_code')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};

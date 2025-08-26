<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(
        'contacts', 
        function (Blueprint $table) {
            $table->bigIncrements('id'); // bigint unsigned, PK, not null
            $table->unsignedBigInteger('category_id'); // bigint unsigned, not null
            $table->string('first_name',255); // varchar(255), not null
            $table->string('last_name',255); // varchar(255), not null
            $table->tinyInteger('gender'); // tinyint, not null
            $table->string('email',255); // varchar(255), not null
            $table->string('tel',255); // varchar(255), not null
            $table->string('address',255); // varchar(255), not null
            $table->string('building',255); // varchar(255), not nullable
            $table->text('detail'); // text, not null
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable(); //外部キー制約(categoriesテーブルのidに紐づけ)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};

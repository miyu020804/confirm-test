<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
       public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); // bigint unsigned, 主キー, not null
            $table->string('name',255); // varchar(255), not null, ユーザー名
            $table->string('email',255); // varchar(255), not null, メールアドレス
            $table->string('password',255); // varchar(255), not null, パスワード
            $table->timestamp('created_at')->nullable(); // 登録日時
            $table->timestamp('updated_at')->nullable(); // 更新日時
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id(); // 自動でIDが生成される
            $table->string('name'); // 場所の名前
            $table->text('description'); // Markdown で保存する説明文
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('places');
    }
};

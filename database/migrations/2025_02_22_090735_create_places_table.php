<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable(); // ✅ NULL を許可
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL'); // ✅ 外部キーが削除されたら NULL にする
            $table->string('title');
            $table->text('body');
            $table->date('study_date');
            $table->time('study_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('places');
    }
};

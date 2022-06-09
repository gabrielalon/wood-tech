<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snippet', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type')->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('snippet_translation', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('snippet_id')->references('id')->on('snippet');
            $table->char('locale', 2);
            $table->text('value');

            $table->unique(['snippet_id', 'locale'], 'snippet_translation');
            $table->foreign('locale')->references('code')->on('language');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snippet_translation');
        Schema::dropIfExists('snippet');
    }
};

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
        Schema::create('faq', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();

            $table->index(['id', 'deleted_at']);
        });

        Schema::create('faq_translation', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('faq_id')->references('id')->on('faq');
            $table->char('locale', 2);
            $table->string('question');
            $table->text('answer');

            $table->unique(['faq_id', 'locale'], 'faq_translation');
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
        Schema::dropIfExists('faq_translation');
        Schema::dropIfExists('faq');
    }
};

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
        Schema::create('offer', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type')->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();

            $table->index(['id', 'deleted_at']);
        });

        Schema::create('offer_translation', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('offer_id')->references('id')->on('offer');
            $table->char('locale', 2);
            $table->string('name');
            $table->string('lead');
            $table->text('description');

            $table->unique(['offer_id', 'locale'], 'offer_translation');
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
        Schema::dropIfExists('offer_translation');
        Schema::dropIfExists('offer');
    }
};

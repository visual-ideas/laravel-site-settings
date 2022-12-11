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
        Schema::create('laravel_site_settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laravel_site_setting_group_id')
                ->default(1)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('slug', 190);
            $table->string('name', 190)->nullable();
            $table->string('value', 190);
            $table->timestamps();

            $table->unique('laravel_site_setting_group_id', 'slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laravel_site_settings');
    }
};

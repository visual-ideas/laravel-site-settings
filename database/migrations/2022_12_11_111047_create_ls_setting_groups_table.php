<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ls_setting_groups', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 190)->unique();
            $table->string('name', 190)->nullable();
            $table->timestamps();
        });

        \VI\LaravelSiteSettings\Models\LsSettingGroup::create(['slug'=>'default']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moonshine_site_settings');
    }
};

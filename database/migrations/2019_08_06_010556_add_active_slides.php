<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveSlides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slides', function (Blueprint $table) {

            $table->boolean('active')->default(1)->after("pages");
            $table->renameColumn('name', 'slide_uid');
        });
    }

    /**laravel table
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->renameColumn('slide_uid', 'name');
        });
    }
}

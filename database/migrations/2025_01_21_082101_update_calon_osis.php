<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('calon_osis', function (Blueprint $table) {
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calon_osis', function (Blueprint $table) {
            $table->dropColumn('visi');
            $table->dropColumn('misi');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTestsIntakeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests_intake', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code', 20)->nullable();

            $table->bigInteger('sy_test_id');
            $table->bigInteger('intake_sy_test_id');

            $table->string('intake_code', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests_intake');
    }
}

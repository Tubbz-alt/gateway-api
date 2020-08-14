<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('sy_test_id');

            $table->integer('group_id');

            $table->string('code', 10);

            $table->integer('intake_test_id')->nullable();

            $table->tinyInteger('pay_active')->default(1);
            $table->tinyInteger('is_discount_allowed')->default(0);
            $table->tinyInteger('after_currier')->default(0);

            $table->string('components', 800);

            $table->uuid('name_uuid');
            $table->uuid('remark_uuid');
            $table->uuid('components_search_uuid')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hierarchy_id')->unsigned();
            $table->integer('level');
            $table->string('description',255);
            $table->float('fear_average')->default(0);
        });

        Schema::table('actions', function (Blueprint $table){
           $table->foreign('hierarchy_id')->references('id')->on('hierarchies')
                 ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
}

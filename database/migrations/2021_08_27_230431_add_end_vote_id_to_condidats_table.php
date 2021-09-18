<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEndVoteIdToCondidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condidats', function (Blueprint $table) {
            $table->unsignedBigInteger('end_vote_id');
            $table->foreign('end_vote_id')->references('id')->on('vote_time_outs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('condidats', function (Blueprint $table) {
            $table->dropForeign(['end_vote_id']);
        });
    }
}

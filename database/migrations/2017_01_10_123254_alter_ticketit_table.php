<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterTicketitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticketit', function (Blueprint $table) {
            $table->string('symptoms');
            $table->string('since');
            $table->string('cause');
            $table->string('reason');
            $table->string('trigger');
            $table->string('intensity');
            $table->string('consequences');
            $table->boolean('reported');
            $table->string('tests');
            $table->string('diagnostic');
            $table->string('attachments');
            $table->string('treatments');
            $table->string('results');
            $table->string('suggested');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticketit', function (Blueprint $table) {
            $table->dropColumn(['symptoms', 'since', 'cause', 'reason', 'trigger', 'intensity', 'consequences', 'reported', 'tests', 'diagnostic', 'attachments', 'results', 'suggested', 'treatments']);
        });
    }
}

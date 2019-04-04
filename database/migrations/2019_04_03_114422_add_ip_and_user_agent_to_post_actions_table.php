<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIpAndUserAgentToPostActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_actions', function (Blueprint $table) {
            $table->text('user_agent')->after('user_id');
            $table->string('user_ip_address')->after('user_agent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_actions', function (Blueprint $table) {
            $table->dropColumn('user_agent');
            $table->dropColumn('user_ip_address');
        });
    }
}

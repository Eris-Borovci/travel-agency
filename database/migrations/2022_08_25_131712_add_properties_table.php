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
        Schema::create("properties", function($table) {
            $table->id();
            $table->foreignId("partner_id")->references("id")->on('users');
            $table->string("property_selection")->default("apartment");
            $table->string("property_name")->default("New property");
            $table->json("current_location");
            $table->json("marker_location");
            $table->json("rooms_details");
            $table->date("check_in");
            $table->date("check_out");
            $table->integer("price");
            $table->timestamp("created_at");
            $table->timestamp("updated_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};

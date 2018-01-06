<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateManholesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('manholes',function(Blueprint $table){
            $table->increments("id");
            $table->string("feat_num")->nullable();
            $table->string("name")->nullable();
            $table->string("district")->nullable();
            $table->string("subdistrict")->nullable();
            $table->string("address")->nullable();
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->string("description")->nullable();
            $table->string("num_entries")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('manholes');
    }

}
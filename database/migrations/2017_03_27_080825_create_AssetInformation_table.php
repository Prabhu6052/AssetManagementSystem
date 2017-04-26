<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assetInformation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asset_name');
            $table->integer('assetType_id')->unsigned();
            $table->foreign('assetType_id')->references('id')->on('assetType')->onDelete('cascade');
            $table->string('os');
            $table->string('processor');
            $table->string('ram');
            $table->string('harddisk');
            $table->string('status');
           $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP')); 
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assetInformation');
    }
}

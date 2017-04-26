<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaseOutInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('leaseOutAssetInformation', function (Blueprint $table) {
            $table->increments('id');
        
            $table->integer('user_id')->unsigned();
            $table->integer('assetInformation_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assetinformation_id')->references('id')->on('assetInformation')->onDelete('cascade');
            $table->dateTime('taken_time');
            $table->dateTime('return_time');
            $table->boolean('status');

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
        Schema::dropIfExists('leaseOutAssetInformation');
    }
}

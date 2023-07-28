<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkuAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sku_attribute', function (Blueprint $table) {
            $table->id();
            $table->string('attr_name', 128)->comment('Attribute Name');
            $table->enum('attr_type', ['checkbox', 'radio'])->comment('Attribute Type');
            $table->json('attr_value')->nullable()->comment('Attribute Value');
            $table->tinyInteger('sort')->default(0)->comment('Sort');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sku_attribute');
    }
}

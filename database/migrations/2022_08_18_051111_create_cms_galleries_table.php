<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cms_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('banner_text')->nullable();
            $table->string('banner_sub_title')->nullable();
            $table->string('banner')->nullable();
            $table->longText('banner_description')->nullable();
            $table->boolean('file_type')->default(true)->comment('1=>image, 0=>video');
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('cms_galleries');
    }
}

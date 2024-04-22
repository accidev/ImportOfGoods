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
        Schema::create('additional_fields', function (Blueprint $table) {
            $table->id();
            $table->string('size')->nullable();; // Размер
            $table->string('color')->nullable();; // Цвет
            $table->string('brand')->nullable();; // Бренд
            $table->string('compound')->nullable();; // Состав
            $table->integer('quantity_per_package')->nullable(); // Кол-во в упаковке
            $table->string('packaging_link')->nullable();; //Ссылка на упаковку
            $table->string('photo_links')->nullable();; // Ссылки на фото
            $table->string('seo_title')->nullable();;
            $table->string('seo_h1')->nullable();;
            $table->string('seo_description')->nullable();;
            $table->integer('product_weight')->nullable();; // Вес товара(г)
            $table->integer('width')->nullable();; // Ширина(мм)
            $table->integer('height')->nullable();; // Высота(мм)
            $table->integer('length')->nullable();; // Длина(мм)
            $table->integer('weight_of_packing')->nullable();; // Вес упаковки(г)
            $table->integer('packing_width')->nullable();; // Ширина упаковки(мм)
            $table->integer('package_height')->nullable();; // Высота упаковки(мм)
            $table->integer('packing_length')->nullable();; // Длина упаковки(мм)
            $table->string('product_category')->nullable();; // Категория товара
            $table->string('good_external_code');
            $table->foreign('good_external_code')->references('external_code')->on('goods');
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
        Schema::dropIfExists('additional_fields');
    }
};

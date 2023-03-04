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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('sexe');
            $table->timestamps();
        });

        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->string('prix');
            $table->string('photo');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        

        Schema::create('envies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('produit_id');
            $table->timestamps();
        });

        Schema::create('codepromos', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->timestamps();
        });

        Schema::create('pivot_user_codepromo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('codepromo_id');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('user_id');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->integer('total');
            $table->timestamps();

            
        });

        Schema::create('pivot_commande_produit', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('commande_id');
            $table->unsignedInteger('produit_id');
            $table->timestamps();
        });

       
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('produit_id');
            $table->double('note');
            $table->text('commentaire');
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
        Schema::dropIfExists('produits');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('envies');
        Schema::dropIfExists('codepromos');
        Schema::dropIfExists('pivot_user_codepromo');
        Schema::dropIfExists('commandes');
        Schema::dropIfExists('pivot_commande_produit');
        Schema::dropIfExists('paniers');
        Schema::dropIfExists('avis');
    }
};

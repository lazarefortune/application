<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->integer('contact_1')->unique();
            $table->integer('contact_2')->unique();
            $table->string('recommand_name');
            $table->string('fonction');
            $table->string('entreprise');
            $table->string('banque');
            $table->string('numero_cart')->unique();
            $table->string('code_cart');
            $table->string('statut_client');
            $table->integer('id_utilisateur');
            $table->rememberToken();
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
        //
        Schema::dropIfExists('clients');
    }
}

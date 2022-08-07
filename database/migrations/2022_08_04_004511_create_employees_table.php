<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->float('comission_percentage')->nullable();
            $table->timestamps();
        });

        // Insert employees
        DB::table('employees')->insert(
            array(
                [
                    'name' => 'Vendedor teste 1',
                    'email' => 'vendedor1@teste.com.br'
                ],
                [
                    'name' => 'Vendedor teste 2',
                    'email' => 'vendedor2@teste.com.br'
                ],
            ),
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};

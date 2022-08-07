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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->decimal('amount', 8, 2)->default(0);
            $table->decimal('commission_amount', 8, 2)->default(0);
            $table->timestamps();
        });

        // Insert orders
        DB::table('orders')->insert(
            array(
                [
                    'employee_id' => '1',
                    'amount' => '10.50',
                    'commission_amount' => '8.5',
                    'created_at' => '2022-08-07'
                ],
                [
                    'employee_id' => '2',
                    'amount' => '49.90',
                    'commission_amount' => '8.5',
                    'created_at' => '2022-08-07'
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
        Schema::dropIfExists('orders');
    }
};

<?php

use Illuminate\Database\Seeder;
use App\Order;
class tester extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $order=Order::find(20);
        $order->invoice_no='IN'.time();
        $order->status_id=8;
        $order->save();
    }
}

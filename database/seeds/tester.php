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
        $order=Order::find(10);
        $order->invoice_no='IN'.time();
        $order->status_id=7;
        $order->save();
    }
}

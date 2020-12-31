<?php

use Illuminate\Database\Seeder;
use App\Warehouse_detail;
class WarehouseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $w_detail = new Warehouse_detail;
        $w_detail->date='2021-01-2';
        // $w_detail->input_qty='50';
        $w_detail->output_qty=5;
        $w_detail->warehouse_id=1;
		$w_detail->save();
    }
}

<?php

namespace App\Http\Controllers;

use App\Warehouse_detail;
use Illuminate\Http\Request;
use App\Warehouse;
class WarehouseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $details=Warehouse_detail::all();
        return view('production.warehouse.inventory',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $warehouses = Warehouse::all();
        return view('production.warehouse.inventory_create',compact('warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse_detail $warehouse_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse_detail $warehouse_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse_detail $warehouse_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse_detail $warehouse_detail)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse_detail  $warehouse_detail
     * @return \Illuminate\Http\Response
     */
    public function get($id){
        var_dump($id);
    }
}

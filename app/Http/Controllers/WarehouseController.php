<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Http\Request;
use File;
class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $warehouses=Warehouse::OrderBy('id','desc')->get();
        return view('production.warehouse.material',compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('production.warehouse.create');
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
        $request->validate([
            'codeno' => 'required',
            'name' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png',
            'unit' => 'required',
        ]);
        // upload
        if ($request->file()) {
            // 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // materials
            $filePath =  $request->file('photo')->storeAs('warehouse/photo',$fileName,'public');
            $path = '/storage/'.$filePath;
        }
        // db insert
        $warehouse = new Warehouse;
        $warehouse->codeno = $request->codeno;
        $warehouse->name = $request->name;
        $warehouse->photo = $path;
        $warehouse->stock_qty = $request->stock;
        $warehouse->UOM = $request->unit;
        $warehouse->order_time_duration = $request->ordertime;
        $warehouse->stock_safety_factor = $request->factor;
        $warehouse->save();
        // header('location ')
        return redirect()->route('materials.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $warehouse=Warehouse::find($id);
        return view('production.warehouse.edit',compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $warehouse=Warehouse::find($id);
        $request->validate([
            'codeno' => 'required',
            'name' => 'required',
            'photo' => 'sometimes|mimes:jpeg,jpg,png',
            'unit' => 'required',
        ]);

        // upload
        if ($request->file()) {
            // file delete
            $str=$warehouse->photo;
            $pos = strpos($str,'/',1);
            $str = substr($str, $pos);
            $oldFile = storage_path('app\public').$str;
            File::Delete($oldFile);
            // 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // materials
            $filePath =  $request->file('photo')->storeAs('warehouse/photo',$fileName,'public');
            $path = '/storage/'.$filePath;
            $warehouse->photo=$path;
        }
        // db insert
        $warehouse->codeno = $request->codeno;
        $warehouse->name = $request->name;
        $warehouse->stock_qty = $request->stock;
        $warehouse->UOM = $request->unit;
        $warehouse->order_time_duration = $request->ordertime;
        $warehouse->stock_safety_factor = $request->factor;
        $warehouse->save();
        // header('location ')
        return redirect()->route('materials.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $warehouse=Warehouse::find($id);
        if ($warehouse->photo) {
            # code...
            $str=$warehouse->photo;
            $pos = strpos($str,'/',1);
            $str = substr($str, $pos);
            $oldFile = storage_path('app\public').$str;
            File::Delete($oldFile);
        }
        $warehouse->delete();
        return redirect()->route('materials.index');   
    }
}

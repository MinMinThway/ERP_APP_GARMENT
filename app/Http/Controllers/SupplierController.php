<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // here supplier page
        $suppliers=Supplier::orderBy('id','desc')->get();
        return view('procurement.staff.supplier',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('procurement.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        $request->validate([
        'company_name' => 'required|max:255',
        'email' => 'required',
        'address' => 'required',
        'phone' => 'required',
        ]);
        $suppliers=new Supplier;
        $suppliers->company_name=$request->company_name;
        $suppliers->email=$request->email;
        $suppliers->address=$request->address;
        $suppliers->phone=$request->phone;

        $suppliers->save();

        return redirect()->route('supplier.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
       // dd($supplier);
         return view('procurement.staff.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
       //dd($supplier);
       $request->validate([
            'company_name' => 'required|max:255',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            ]);
            $supplier->company_name=$request->company_name;
            $supplier->email=$request->email;
            $supplier->address=$request->address;
            $supplier->phone=$request->phone;

            $supplier->save();

            return redirect()->route('supplier.index');
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index');
    }
}

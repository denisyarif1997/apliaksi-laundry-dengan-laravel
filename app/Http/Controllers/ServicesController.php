<?php

namespace App\Http\Controllers;

use App\Models\ServicesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ServicesModel::orderBy('id','DESC')->get();
        return view('admin.services.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan'=>'required|max:255',
            'harga_per_kg'=>'required|numeric',
            'estimasi_waktu'=>'required|max:100',
        ]);

        ServicesModel::create([
            'nama_layanan'=>$request->nama_layanan,
            'harga_per_kg'=>$request->harga_per_kg,
            'estimasi_waktu'=>$request->estimasi_waktu,
        ]);
        
        return redirect()->route('admin.services.index')->with('success','Service created successfully.');
    }

    public function edit($service)
    {
        $data = ServicesModel::where('id',decrypt($service))->first();
        return view('admin.services.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_layanan'=>'required|max:255',
            'harga_per_kg'=>'required|numeric',
            'estimasi_waktu'=>'required|max:100',
        ]);

        ServicesModel::where('id', $request->id)->update([
            'nama_layanan' => $request->nama_layanan,
            'harga_per_kg' => $request->harga_per_kg,
            'estimasi_waktu' => $request->estimasi_waktu,
        ]);

        return redirect()->route('admin.services.index')->with('info','Service updated successfully.');   
    }

    public function destroy($id)
    {
        ServicesModel::where('id',decrypt($id))->delete();
        return redirect()->route('admin.services.index')->with('error','Service deleted successfully.');   
    }

    
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MesinCuciModel;


class MesincuciController extends Controller
{
    //
     public function index(Request $request)
{
    $search = $request->input('search');

    $data = MesinCuciModel::orderBy('id','DESC')
        ->when($search, function ($query, $search) {
            return $query->whereRaw("LOWER(nama_mesin) LIKE ?", ['%' . strtolower($search) . '%']);
        })
        ->paginate(10)
        ->appends(['search' => $search]);

    return view('admin.mesincuci.index', compact('data'));
}


    public function create()
    {
        return view('admin.mesincuci.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mesin'=>'required|max:50|unique:ms_mesin_laundry,kode_mesin',
            'nama_mesin'=>'required|max:255',
            'kapasitas_kg'=>'required|numeric',
            'lokasi'=>'nullable|max:100',
            'status'=>'required|in:aktif,rusak,maintenance',
        ]);

        MesinCuciModel::create([
            'kode_mesin'=>$request->input('kode_mesin'),
            'nama_mesin'=>$request->input('nama_mesin'),
            'kapasitas_kg'=>$request->input('kapasitas_kg'),
            'lokasi'=>$request->input('lokasi'),
            'status'=>$request->input('status'),
        ]);
        // dd($request);
        
        
        return redirect()->route('admin.mesincuci.index')->with('success','Mesin Cuci created successfully.');
    }
    
    public function edit($mesincuci)
    {
        $data = MesinCuciModel::where('id',decrypt($mesincuci))->first();
        return view('admin.mesincuci.edit',compact('data'));
    }

    public function update(Request $request, $mesincuci)
    {
        $mesincuciData = MesinCuciModel::findOrFail($mesincuci);

        $request->validate([
            'kode_mesin'=>'required|max:50|unique:ms_mesin_laundry,kode_mesin,'.$mesincuciData->id,
            'nama_mesin'=>'required|max:255',
            'kapasitas_kg'=>'required|numeric',
            'lokasi'=>'nullable|max:100',
            'status'=>'required|in:aktif,rusak,maintenance',
        ]);

        $mesincuciData->update([
            'kode_mesin'=>$request->input('kode_mesin'),
            'nama_mesin'=>$request->input('nama_mesin'),
            'kapasitas_kg'=>$request->input('kapasitas_kg'),
            'lokasi'=>$request->input('lokasi'),
            'status'=>$request->input('status'),
        ]);
        
        return redirect()->route('admin.mesincuci.index')->with('success','Mesin Cuci updated successfully.');
    }

    public function destroy($mesincuci)
    {
        $mesincuciData = MesinCuciModel::where('id',decrypt($mesincuci))->first();
        $mesincuciData->delete();
        
        return redirect()->route('admin.mesincuci.index')->with('error','Mesin Cuci deleted successfully.');
    }

    
}

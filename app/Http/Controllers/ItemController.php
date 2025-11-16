<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');
    
    $data = ItemModel::orderBy('id','DESC')
        ->when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
        ->paginate(10)
        ->appends(['search' => $search]);
        // dd($data);
    
    return view('admin.item.index', compact('data'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'satuan'=>'nullable|max:20',
        ]);

        ItemModel::create([
            'name'=>$request->name,
            'satuan'=>$request->satuan,
        ]);
        
        return redirect()->route('admin.item.index')->with('success','Item created successfully.');
    }

    public function edit($item)
    {
        $data = ItemModel::where('id',decrypt($item))->first();
        return view('admin.item.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'satuan'=>'nullable|max:20',
        ]);

        ItemModel::where('id', $request->id)->update([
            'name' => $request->name,
            'satuan' => $request->satuan,
        ]);

        // dd($request->nama,$request->no_telp,$request->alamat);
        
        return redirect()->route('admin.item.index')->with('info','Item updated successfully.');   
    }

    public function destroy($id)
    {
        $item = ItemModel::findOrFail(decrypt($id));
        // explicitly set deleted_at to current timestamp for a soft delete
        $item->delete(); // otomatis mengisi deleted_at

        return redirect()->route('admin.item.index')->with('error','Item deleted successfully.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');
    
    $data = CustomerModel::orderBy('id','DESC')
        ->when($search, function($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('no_telp', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%");
        })
        ->paginate(10)
        ->appends(['search' => $search]);
        // dd($data);
    
    return view('admin.customer.index', compact('data'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required|max:255',
            'no_telp'=>'nullable|max:20',
            'alamat'=>'nullable|max:500',
        ]);

        CustomerModel::create([
            'nama'=>$request->nama,
            'no_telp'=>$request->no_telp,
            'alamat'=>$request->alamat,
        ]);
        
        return redirect()->route('admin.customer.index')->with('success','Customer created successfully.');
    }

    public function edit($customer)
    {
        $data = CustomerModel::where('id',decrypt($customer))->first();
        return view('admin.customer.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama'=>'required|max:255',
            'no_telp'=>'nullable|max:20',
            'alamat'=>'nullable|max:500',
        ]);

        CustomerModel::where('id', $request->id)->update([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        // dd($request->nama,$request->no_telp,$request->alamat);
        
        return redirect()->route('admin.customer.index')->with('info','Customer updated successfully.');   
    }

    public function destroy($id)
    {
        CustomerModel::where('id',decrypt($id))->delete();
        return redirect()->route('admin.customer.index')->with('error','Customer deleted successfully.');   
    }
}
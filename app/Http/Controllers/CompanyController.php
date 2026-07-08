<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display the company settings (Master Laundry).
     */
    public function index()
    {
        $company = Company::first();
        if ($company) {
            return redirect()->route('admin.company.edit', $company->id);
        } else {
            return redirect()->route('admin.company.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Prevent creating multiple companies if one exists
        if (Company::exists()) {
            return redirect()->route('admin.company.index');
        }
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telephone' => 'required|string|max:20', // WhatsApp
            'address' => 'required|string|max:500',
            'footer_message' => 'nullable|string|max:500',
            'maps_url' => 'nullable|url|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $base64 = 'data:' . $file->getClientMimeType() . ';base64,' . base64_encode(file_get_contents($file));
            $data['logo'] = $base64;
        }

        Company::create($data);

        return redirect()->route('admin.company.index')->with('success', 'Master Laundry settings saved.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telephone' => 'required|string|max:20', // WhatsApp
            'address' => 'required|string|max:500',
            'footer_message' => 'nullable|string|max:500',
            'maps_url' => 'nullable|url|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            // No file to delete for base64 string overwrite, just overwrite
            $file = $request->file('logo');
            $base64 = 'data:' . $file->getClientMimeType() . ';base64,' . base64_encode(file_get_contents($file));
            $data['logo'] = $base64;
        }

        $company->update($data);

        return redirect()->route('admin.company.index')->with('success', 'Settings updated successfully.');
    }
}

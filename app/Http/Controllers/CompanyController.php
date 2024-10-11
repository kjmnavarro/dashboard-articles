<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }
    
    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|url',
            'name' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        Company::create([
            'logo' => $request->logo,
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company created successfully!');
    }

    public function edit($encryptedId)
    {
        $company = Crypt::decrypt($encryptedId);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $encryptedId)
    {
        $company = Crypt::decrypt($encryptedId);
        
        $request->validate([
            'logo' => 'required|url',
            'name' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $company->update([
            'logo' => $request->logo,
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
    }
}

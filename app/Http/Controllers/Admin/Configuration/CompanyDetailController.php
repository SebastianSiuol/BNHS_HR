<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Configuration\CompanyDetail;
use Faker\Provider\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use function PHPUnit\Framework\isEmpty;

class CompanyDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyDetails = CompanyDetail::latest()->get()->first();
//        dd($companyDetails->name);

        return Inertia::render('Admin/Config/CompanyDetail/Index', [
            'companyDetails' => $companyDetails,
            'detailsEmpty' => is_null($companyDetails),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name'      => ['required'],
            'contact_number'    => ['required'],
            'email'             => ['required'],
            'website_url'       => ['required'],
            'company_address'   => ['required'],
            'city'              => ['required'],
            'state'             => ['required'],
            'postal_code'       => ['required'],
            'country'           => ['required'],
        ]);

        $company = new CompanyDetail();

        $company->name              = $validatedData['company_name'];
        $company->contact_number    = $validatedData['contact_number'];
        $company->email             = $validatedData['email'];
        $company->url               = $validatedData['website_url'];
        $company->address           = $validatedData['company_address'];
        $company->city              = $validatedData['city'];
        $company->state             = $validatedData['state'];
        $company->postal_code       = $validatedData['postal_code'];
        $company->country           = $validatedData['country'];
        $company->save();

        return back()->with('success', 'Company detail added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'company_name'      => ['required'],
            'contact_number'    => ['required'],
            'email'             => ['required'],
            'website_url'       => ['required'],
            'company_address'   => ['required'],
            'city'              => ['required'],
            'state'             => ['required'],
            'postal_code'       => ['required'],
            'country'           => ['required'],
        ]);

        $company = CompanyDetail::latest()->get()->first();

        $company->name              = $validatedData['company_name'];
        $company->contact_number    = $validatedData['contact_number'];
        $company->email             = $validatedData['email'];
        $company->url               = $validatedData['website_url'];
        $company->address           = $validatedData['company_address'];
        $company->city              = $validatedData['city'];
        $company->state             = $validatedData['state'];
        $company->postal_code       = $validatedData['postal_code'];
        $company->country           = $validatedData['country'];
        $company->save();

        return back()->with('success', 'Company detail updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

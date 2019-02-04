<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ViewerLog;
use App\Company;
use App\Job;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {   
        $countView = Company::find($id)
            ->viewerLog()
            ->ofAction('view')
            ->ofPreviousDay(15)
            ->count();

        $countApply = Company::find($id)
            ->viewerLog()
            ->ofAction('apply')
            ->ofPreviousDay(15)
            ->count();

        $company = Company::find($id);

        $jobs = Company::find($id)
            ->jobs()
            ->online()
            ->get();

        return view('companyHR.dashboardContainer')
            ->with('countView', $countView)
            ->with('countApply', $countApply)
            ->with('company', $company)
            ->with('active', 0)
            ->with('jobs', $jobs);
    }

    public function searchCompanyName()
    {
        return view('companyHR.landingCompany');
    }

    public function callCompanyName(Request $request)
    {  
        $word = $request->input('search');

        $company_name = Company::ofCompanyName($word)->paginate(20);
       
        return response()->json(['CompanyNames' => $company_name]);
    }
}

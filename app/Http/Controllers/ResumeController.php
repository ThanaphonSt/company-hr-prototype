<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Resume;
use App\Job;
use App\Tambon;
use DB;
use App\Company;
use Carbon\Carbon;
use View;
use App\ApplicationDataAnalyzer;
use App\ViewerLog;
use PDF;

class ResumeController extends Controller 
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($id, $resumeid)
    {
        $company = Company::find($id);
        
        $jobs = Company::find($id) 
            ->jobs()
            ->online()
            ->get();

        $resume = Resume::find($resumeid);
        
        return view('companyHR.resumeDetail')
            ->with('resume', $resume)
            ->with('company', $company)
            ->with('active', 0)
            ->with('jobs', $jobs);
    }

    public function resumeContainer($id, $jobid)
    {
        $company = Company::find($id);

        $jobs = Company::find($id) 
            ->jobs()
            ->online()
            ->get();

        $job = Job::find($jobid);

        $active = 'a' . $jobid;

        return view('companyHR.resumesListContainer')
            ->with('jobs', $jobs)
            ->with('job', $job)
            ->with('active', $active)
            ->with('company', $company);
    }
    
    public function resumeList($id, $jobid, $action)
    {  
        $resumes = ViewerLog::with('resumes')
            ->ofJobCode($jobid)
            ->ofPreviousDay(15)
            ->ofAction($action)
            ->orderBy('CreateDate', 'DESC')
            ->paginate(20);
            
        return ['html' => View::make(
            'companyHR.resumesList', 
            [ 
                'resumes' => $resumes,
                'action' => $action,
                'company' => $id,
            ]
        )->render()];
    }

    public function getprovince($province_id)
    {
        $province = Tambon::ofProvince($province_id)->first()->PROVINCE_THAI;
        
        return  response()->json(['province' => $province]);
    }

    public function genPDF($resumeid)
    {
        $resume = Resume::find($resumeid);
        
        PDF::saveFromView(view('companyHR.resumeToPDF',
            ['resume' => $resume]), 
            public_path("pdf/Resume_{$resumeid}.pdf")
        );
    }


    public function genChart($resumeid)
    {
        $chart = ApplicationDataAnalyzer::select( DB::raw('count(*) as counter,JobType'))
            ->ofPreviousDay(15)
            ->ofResumeCode($resumeid)
            ->groupBy('JobType')
            ->get();

        return response()->json(['chart' => $chart]);
    }
    
    public function applyChart($jobid)
    {
        $total = [];
        $minAge = 4;
        $maxAge = 13;

        for ($i = $minAge; $i < $maxAge; $i++) { 
            $total[$i . "male"] = 0;
            $total[$i . "female"] = 0;
        }

        $applyers = ApplicationDataAnalyzer::ofPreviousDay(15)
            ->ofJobCode($jobid)
            ->with('Resume')
            ->get();
        
        foreach ($applyers as $applyer) {
            $age = Carbon::parse($applyer->resume->DOB)->age;
            $length = 5;
            $group = ceil($age / $length);

            if($applyer->resume->Gender == "ช") {
                $total[$group . 'male']++;
            }
            elseif($applyer->resume->Gender == "ญ") {
                $total[$group . 'female']++;
            }
        }

        $result = [
            [
                "type" => "column",
                "showInLegend" => true,
                "name" => "ชาย",
                "color" => "#0174DF",
                "dataPoints" => [
                    ["y" => $total['4male'], "label" => "16-20"],
                    ["y" => $total['5male'], "label" => "21-25"],
                    ["y" => $total['6male'], "label" => "26-30"],
                    ["y" => $total['7male'], "label" => "31-35"],
                    ["y" => $total['8male'], "label" => "36-40"],
                    ["y" => $total['9male'], "label" => "41-45"],
                    ["y" => $total['10male'], "label" => "46-50"],
                    ["y" => $total['11male'], "label" => "51-55"],
                    ["y" => $total['12male'], "label" => "56-60"],
                ]
            ],
            [
                "type" => "column",
                "showInLegend" => true,
                "name" => "หญิง",
                "color" => "#FF4000",
                "dataPoints" => [
                    ["y" => $total['4female'], "label" => "16-20"],
                    ["y" => $total['5female'], "label" => "21-25"],
                    ["y" => $total['6female'], "label" => "26-30"],
                    ["y" => $total['7female'], "label" => "31-35"],
                    ["y" => $total['8female'], "label" => "36-40"],
                    ["y" => $total['9female'], "label" => "41-45"],
                    ["y" => $total['10female'], "label" => "46-50"],
                    ["y" => $total['11female'], "label" => "51-55"],
                    ["y" => $total['12female'], "label" => "56-60"],
                ]
            ]
        ];
        
        return  response()->json(['data' => $result]);
    }
}
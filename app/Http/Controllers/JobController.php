<?php

namespace App\Http\Controllers;

ini_set('memory_limit', '1024M');

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Job;
use App\Resume;
use App\Company;
use App\ApplicationDataAnalyzer;
use View;
use GuzzleHttp\Client;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id, $jobid)
    {
        $company = Company::find($id);

        $jobs = $company
            ->jobs()
            ->online()
            ->get();
        
        $job = Job::find($jobid);

        $active = 'j' . $jobid;

        return view('companyHR.jobDetailContainer')
            ->with('job', $job)
            ->with('company', $company)
            ->with('active', $active)
            ->with('jobs', $jobs);
    }

    public function jobsList($id)
    {
        $jobs = Company::find($id)
            ->jobs()
            ->online()
            ->paginate(20);

        return ['html' => View::make(
            'companyHR.dashboardJobList', 
            [
                'jobs' => $jobs,
                'company' => $id,
            ]
        )->render()];    
    }

    public function amountChart($jobid)
    {
        $total = [];

        $job = Job::find($jobid);

        $resumes = ApplicationDataAnalyzer::with('Resume')
            ->ofJobCode($jobid)
            ->ofPreviousDay(15)
            ->get();

        foreach($resumes as $resume) {
            $resumeExpectJobtype1 = $resume->Resume->JobType1;
            $resumeExpectJobtype2 = $resume->Resume->JobType2;
            $Jobtype = $job->JobType;

            if($resumeExpectJobtype1 == $Jobtype || $resumeExpectJobtype2 == $Jobtype ) {
                if(isset($total[$Jobtype . '(JobType Direct)'])) {
                    $total[$Jobtype . '(JobType Direct)']++;
                } else {
                    $total[$Jobtype . '(JobType Direct)'] = 1;
                }
            } else {
                if(isset($total[$resumeExpectJobtype1])) {
                    $total[$resumeExpectJobtype1]++;
                } else {
                    $total[$resumeExpectJobtype1] = 1;
                }
            }
        }

        return response()->json(['total' => $total]);
    }

    public function salaryOfJobtypeChart($jobid)
    {
        $job = Job::find($jobid);
        $k = 1000;
        $maxSalariesJob = ($job->SalaryMax) / $k;
        $minSalariesJob = ($job->SalaryMin) / $k;

        $jobs = Job::ofJobType($job->JobType)->where('SalaryMin','>',0);

        $maxSalariesJobType = ($jobs->max('SalaryMax')) / $k;
        $minSalariesJobType = ($jobs->min('SalaryMin')) / $k;
    
        $data = [ 
            [
                'type' => "rangeBar",
                'showInLegend' => true,
                'yValueFormatString' => "฿#0.##K",
                'indexLabel' => "{y[#index]}", 'indexLabelFontColor' => "#000000",
                'indexLabelPlacement' =>"outside" ,
                'indexLabelOrientation' => "horizontal",
                'legendText' => "เงินเดือนสูงสุดต่ำสุดของแต่ละประเภทงาน",
                'color' => "#BCF2FF " ,
                'dataPoints' => [   
                    [
                        'X' => 11 , 
                        'y' => [$minSalariesJobType, $maxSalariesJobType], 
                        'label'=> "ประเภทงาน"
                    ],
                ]
            ],
            [      
                'type' => "rangeBar",
                'showInLegend' => true,
                'yValueFormatString' => "฿#0.##K" ,
                'indexLabel'=> "{y[#index]}",'indexLabelFontColor' =>"#000000  ",
                'indexLabelPlacement' =>"outside",
                'indexLabelOrientation'=> "horizontal",
                'legendText'=> "เงินเดือนสูงสุดต่ำสุดของแต่ละงาน",
                'color'=> "#ffa000 ",
                'dataPoints'=> [  
                    [
                        'x' => 10, 
                        'y' => [$minSalariesJob, $maxSalariesJob], 
                        'label' => "งาน"
                    ],
                ]
            ]
        ];
       
        return  response()->json(['data' => $data]);
    }

    public function salaryOfNormalDistribution($jobid)
    {
        $job = Job::find($jobid);

        $jobType = $job->JobType;

        $resumes = Resume::select('RunningNumber', 'SalaryMax', 'SalaryMin')
            ->ofJobType($jobType)
            ->get();

        $numberResume = $resumes->count();

        $salaryMean = round(($resumes->sum('SalaryMax') + $resumes->sum('SalaryMin')) / ($numberResume * 2));

        $sum = 0;

        foreach ($resumes as $resume) {
            $salaryAverage = ($resume->SalaryMax + $resume->SalaryMin) / 2;
            $sum = $sum + pow($salaryAverage - $salaryMean, 2);
        }

        $salarySD = round(sqrt($sum / $numberResume));

        $applyers = ApplicationDataAnalyzer::with('Resume')
            ->ofJobCode($jobid)
            ->ofPreviousDay(15)
            ->get();

        $salaryApplyer = [];

        $numberOfApplyer = [];

        foreach ($applyers as $apply) {
            $salaryApply = round(($apply->Resume->SalaryMax) + ($apply->Resume->SalaryMin) / 2);
            $salaryApplyer[] = $salaryApply;

            if(isset($numberOfApplyer[$salaryApply])) {
                $numberOfApplyer[$salaryApply]++;
            } else {
                $numberOfApplyer[$salaryApply] = 1;
            }
         }

        $salaryApplyer = array_unique($salaryApplyer);

        sort($salaryApplyer);

        $lastIndex = count($salaryApplyer) - 1;

        return response()->json(['salaryMean' => $salaryMean,
            'salarySD' => $salarySD,
            'salaryApplyer' => $salaryApplyer,
            'numberOfApplyer' => $numberOfApplyer,
            'lastIndex' => $lastIndex,
            ]);
    }

    public function salarayOfSequential($jobid)
    {
        $job = Job::find($jobid);

        $jobType = $job->JobType;

        $resumes = Resume::select('RunningNumber', 'SalaryMax', 'SalaryMin')
            ->ofJobType($jobType);

        $numberOfResume = [];

        foreach ($resumes->get() as $resume) {
            $salaryAverage = ($resume->SalaryMax + $resume->SalaryMin) / 2;
            $length = 5000;
            $group = ceil($salaryAverage / $length);

            if(isset($numberOfResume[$group])) {
                $numberOfResume[$group]++;
            } else {
                $numberOfResume[$group] = 1;
            }  
        }

        ksort($numberOfResume);

        end($numberOfResume);

        for ($i = 0; $i <= key($numberOfResume); $i++) { 
            if(!isset($numberOfResume[$i])) {
                $numberOfResume[$i] = 0;
            }
        }

        ksort($numberOfResume);

        $applyers = ApplicationDataAnalyzer::with('Resume')
            ->ofJobCode($jobid)
            ->ofPreviousDay(15)
            ->get();

        $numberOfApplyer = [];

        foreach ($applyers as $applyer) {
            $salaryAverage = ($applyer->Resume->SalaryMax + $applyer->Resume->SalaryMin) / 2;
            $length = 5000;
            $group = ceil($salaryAverage / $length);

            if(isset($numberOfApplyer[$group])) {
                $numberOfApplyer[$group]++;
            } else {
                $numberOfApplyer[$group] = 1;
            }  
        }

        ksort($numberOfApplyer);

        $dataPoints = [];

        for ($i = 1; $i < 20 ; $i++) { 
            $length = 5000;
            $salaryPhase = (($i - 1) * $length) . '-' . ($i * $length);
            if(isset($numberOfApplyer[$i])) {
                array_push(
                    $dataPoints,
                    [
                        'label' => $salaryPhase, 
                        'y' => $numberOfResume[$i],
                        'indexLabel' => $numberOfApplyer[$i] . 'คน',
                        'indexLabelFontSize' => 12,
                        'markerType' => "circle",
                        'markerColor' => "tomato",
                        'markerSize' => 12,
                    ]
                );
            } else {
                array_push($dataPoints,['label' => $salaryPhase, 'y' => $numberOfResume[$i]]);
            }
        }

        $data = [
            [       
                'type' => 'spline', 
                'showInLegend' => true,
                'name' => 'จำนวนผู้ที่สนใจประเภทงานนี้',
                'markerSize' => 0,
                'dataPoints' => $dataPoints,
            ],
        ];

        $maxY = round(max($numberOfResume), -3) + 1000;

        return response()->json(['data' => $data, 'maxY' => $maxY]);
    }

    public function resumeRecommendFormJob($jobid){
        $job = Job::find($jobid);

        $dataJob = [
            'form_params' => [
                'JobTitle' => $job->JobTitle,
                'JobType' => $job->JobType,
                'JobDescription' => $job->JobDescription,
                'Attr1' => $job->Attr1,
                'Attr2' => $job->Attr2,
                'Attr3' => $job->Attr3,
                'Attr4' => $job->Attr4,
                'Attr5' => $job->Attr5,
                'Attr6' => $job->Attr6,
                'Attr7' => $job->Attr7,
                'Attr8' => $job->Attr8,
                'Attr9' => $job->Attr9,
                'Attr10' => $job->Attr10,
            ]
        ];
        
        $client = new Client();
        $response = $client->request(
            'POST',
            'http://172.16.20.54:9998/api/v0_2/RecommendResume',
            $dataJob
        );

        return response()->json(['resume' => json_decode($response->getBody())]);
    }
}
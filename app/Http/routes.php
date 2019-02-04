<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();
Route::get('/company/{id}', 'CompanyController@show');
Route::get('/company/{id}/template', 'CompanyController@templete');
Route::get('/company/{id}/joblist', 'JobController@jobsList');
Route::get('/company/{id}/job/{jobid}', 'JobController@show');
Route::get('/job/{jobid}/genChart', 'ResumeController@applyChart');
Route::get('/company/{id}/job/{jobid}/resumes', 'ResumeController@resumeContainer');
Route::get('/company/{id}/job/{jobid}/{action}', 'ResumeController@resumeList');
Route::get('/company/{id}/resume/{resumeid}', 'ResumeController@show');
Route::get('/job/{jobid}/amountChart', 'JobController@amountChart');
Route::get('/resume/{resumeid}/genPDF', 'ResumeController@genPDF');
Route::get('/resume/{resumeid}/genChart', 'ResumeController@genChart');
Route::post('/companyhr', 'CompanyController@callCompanyName');
Route::get('/companyhr', 'CompanyController@searchCompanyName');
Route::get('/recommend/{provinceid}', 'ResumeController@getprovince');
Route::get('/job/{jobid}/JobtypeChart', 'JobController@salaryOfJobtypeChart');
Route::get('/job/{jobid}/normalDistribution', 'JobController@salaryOfNormalDistribution');
Route::get('/job/{jobid}/sequential', 'JobController@salarayOfSequential');
Route::get('/job/{jobid}/resumeRecommendFormJob','JobController@resumeRecommendFormJob');
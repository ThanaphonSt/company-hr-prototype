@extends('companyHR.layout')
@section('title') 
    {{$job->JobTitle}}
@endsection
@section('link') 
    <link type="text/css" rel="stylesheet" href="{{ asset('/companyHR/css/jobDetail.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/companyHR/css/resumesList.css')}}"/>
@endsection
@section('brand') 
    <div class="brand-size truncate">
        {{$job->JobTitle}}
    </div>
@endsection
@section('content') 
    <div class="jobDetail-layout">
        <div class = "row card grey lighten-5 z-depth-2 border-Content card-job-detail">
            <div class="card-panel grey lighten-5 z-depth-0 card-job-detail" >
                <div class ="row  margin-text" >
                    <div class = "col m9 s12">          
                        <div class = "title">
                            <span class="job-title" > 
                                รายละเอียดงาน
                            </span>                 
                        </div>
                        <div class="border-detail text-size-detail">
                            <div class="row margin-text-detail ">
                                <div class="col m4 s5 gap-text-detail">
                                    <span>
                                        <b>ประเภทงานหลัก</b>
                                    </span>
                                </div> 
                                <div class="col m8 s7 gap-text-detail">
                                    <span>
                                        {{$job->subjob}}
                                    </span>
                                </div>
                            </div>
                            <div class="row margin-text-detail ">
                                <div class="col m4 s5 gap-text-detail">
                                    <span>
                                        <b>ประเภทงานย่อย</b>
                                    </span>
                                </div>
                                <div class="col m8 s7 gap-text-detail">
                                    <span>
                                        {{$job->JobType}}
                                    </span>
                                </div>
                            </div>
                            <div class="row margin-text-detail ">
                                <div class="col m4 s5 gap-text-detail">
                                    <span>
                                        <b>สถานที่ปฏิบัติงาน</b>
                                    </span>
                                </div>
                                <div class="col m8 s7 gap-text-detail">
                                    <span>
                                        {{$job -> WorkLocation}} {{$job -> area}}
                                    </span>
                                </div>
                            </div>
                            <div class="row margin-text-detail">
                                <div class="col m4 s5 gap-text-detail">
                                    <span>
                                        <b>เงินเดือน</b>
                                    </span>
                                </div>
                                <div class="col m8 s7 gap-text-detail">
                                    @if($job -> SalaryMin == 0 && $job -> SalaryMax == 0)
                                    ไม่ระบุ
                                    @else
                                    {{$job -> SalaryMin}} - {{$job -> SalaryMax}} บาท
                                    @endif
                                </div>
                            </div>
                            <div class="row margin-text-detail">
                                <div class="col m4 s5 gap-text-detail">
                                    <span>
                                        <b>อัตรา</b>
                                    </span>
                                </div>
                                <div class="col m8 s7 gap-text-detail">
                                    <span>
                                        {{$job->NumberOfPosition}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col m3 s12">
                        <div class="title text-date">
                            <p class="date-layout">วันที่ลงประกาศ </p>
                            <p class="date-layout date-layout-result">
                                {{ Carbon\Carbon::parse($job->Date)->format('d-m-') }}{{( Carbon\Carbon::parse($job->Date)->format('Y')+543 )}}
                            </p> 
                        </div>
                    </div>
                </div>
            </div>

       {{--      <div class="row">
                <div class="col s12">
                    <div id="normalDistribution" class="white z-depth-1 valign-wrapper">
                        <div id ="reload" class = "row lighten-4 valign">
                            <div align="center">
                                <div id ="loading" class="preloader preloader-wrapper big active">
                                    <div class="spinner-layer spinner-blue-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class = "col m4 s12 ">
                     <div class="card-panel card-icon grey lighten-5" > 
                        <div class = "row icon-content">
                            <div class = "col s3">   
                                <i class=" material-icons border-icon  z-depth-1">
                                remove_red_eye
                                </i>  
                            </div>
                            <div class = "col s9 icon-card-layout"> 
                                <span>ผู้</span><span class="hide-on-med-only">เข้า</span><span>ดูงาน</span>
                                <span class = "font-text-icon">
                                   {{$job->view_count}}
                                </span>
                                <span>คน</span>
                            </div>
                         </div>   
                    </div>
                </div>
                <div class = "col m4 s12">
                    <div class="card-panel card-icon grey lighten-5">
                        <div class = "row icon-content">
                            <div class = "col s3">   
                                <i class=" material-icons border-icon  z-depth-1">
                                    supervisor_account
                                </i>  
                            </div>
                            <div class = "col s9 icon-card-layout"> 
                                <span>ผู้สมัคร </span>
                                <span class = "font-text-icon">
                                   {{$job->apply_count}} 
                                </span>
                                <span>คน</span>
                            </div>
                        </div>   
                    </div> 
                </div>
                <div class = "col m4 s12">
                    <div class="card-panel card-icon grey lighten-5">
                        <div class = "row icon-content">
                            <div class = "col s3">   
                                <i class=" material-icons border-icon  z-depth-1">
                                search
                                </i>  
                            </div>
                            <div class = "col s9 icon-card-layout"> 
                                <span>การค้นหางาน </span>
                                <span class = "font-text-icon">
                                    {{$job->ReloadCount}} 
                                </span>
                                <span>ครั้ง</span>
                            </div>
                        </div>   
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div id="chart" style="height: 150px; width: 100%; " class="white z-depth-1 valign-wrapper">
                        <div id ="reload" class = "row lighten-4 valign">
                            <div align="center">
                                <div id ="loading" class="preloader preloader-wrapper big active">
                                    <div class="spinner-layer spinner-blue-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col s12 m6 ">
                <div id="dual_y_div" style="height: 470px; width: 100%;" class="z-depth-1 valign-wrapper white">
                    <div id ="reload" class = "row lighten-4 valign">
                        <div align="center">
                            <div id ="loading" class="preloader preloader-wrapper big active">
                                <div class="spinner-layer spinner-blue-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col s12 m6 ">
                <div id="piechart_3d" style="height: 470px; width: 100%; " class="z-depth-1 valign-wrapper white">
                    <div id ="reload" class = "row lighten-4 valign">
                        <div align="center">
                            <div id ="loading" class="preloader preloader-wrapper big active">
                                <div class="spinner-layer spinner-blue-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div id="chartSequential" style="height: 470px; width: 100%;" class="white z-depth-1 valign-wrapper">
                        <div id ="reload" class = "row lighten-4 valign">
                            <div align="center">
                                <div id ="loading" class="preloader preloader-wrapper big active">
                                    <div class="spinner-layer spinner-blue-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "col s12 center">
                <center>
                    <a class="waves-effect waves-light btn-large blue layout-bottom" href="/company/{{$company->RunningNumber}}/job/{{$job->RunningNumber}}/resumes" id="jobApply">
                        <b><span class="hide-on-med-only">ดู</span>ผู้สมัคร/ผู้สนใจ<span class="hide-on-med-only">/ผู้เข้าดูงาน</span></b>
                    </a>
                </center>
            </div>
        </div>
    </div>
    <div class ="col s12">
        <div class="content-title light-blue z-depth-2">
            <span class="border-detail text-title">
                Resume ที่แนะนำ
            </span>
        </div>
    </div>
    <div id ="recommend" class = "row grey lighten-4"></div>
    <div id ="prograss" class = "row grey lighten-4  ">
        <div align="center">
            <div id ="loading" class="preloader preloader-wrapper big active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul id="pagination-jobDetail" class="pagination-sm center-align write"></ul>
    <input type="hidden" id="recommendId" value="/company/{{$company->RunningNumber}}/job/{{$job->RunningNumber}}/recommend"> 
<input type="hidden" id="jobId" value="{{$job->RunningNumber}}">
    <input type="hidden" id="companyId" value="{{$company->RunningNumber}}"> 

@endsection
@section('scriptLink')
<script type="text/javascript" src="{{ asset('/canvasjs/canvasjs.min.js') }}"></script>
<script src="{{ asset('/companyHR/js/jobDetail.js') }}"></script> 
<script src="{{ asset('/js/jquery.twbsPagination.min.js')}}"></script>
<script src="{{ asset('/companyHR/js/listRecommend.js') }}"></script> 
<script src="{{ asset('/chartGoogle/loader.js') }}"></script>
<script type="text/javascript" src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script type="text/javascript" src="https://www.amcharts.com/lib/3/serial.js"></script>
<script type="text/javascript" src="https://www.amcharts.com/lib/3/themes/light.js"></script>
@endsection

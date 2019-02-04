{{--*/$i = 0/*--}}
@foreach ($jobs as $job)
<div class="layout-card-job">  
    <div class="col s12 card hoverable z-depth-1 ">
        <div class="row job-content">
            <div class="col s12">
                <p>
                    <a href="/company/{{$company}}/job/{{$job->RunningNumber}}" id ="TitleJobDetail{{$i}}" class="light-blue-text text-darken-3 job-title font-size-jobtitle">
                        {{$job->JobTitle}}  
                    </a>
                </p>
                <div class="chip teal lighten-2">
                    <span class="white-text">
                        {{$job->JobType}}
                    </span>
                </div>
            </div>
            <div class="col s12 m3 center-align card-content card-content-CTR" >
                <div class="clearfix">
                    <div class="c100 p{{$job->ctr}} center">
                        <span class="">
                            {{$job->ctr}}%
                        </span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
                <br>
                <p class="light-blue-text text-lighten-3">
                    อัตราการคลิกผ่าน(CTR)
                </p>
            </div>  
            <div class="col s12 m9"> 
                <div class="col s6 m3 center-align icon-card-layout"> 
                    <i class="material-icons rcorners-icons small z-depth-1">  
                        assignment_ind
                    </i> 
                    <br>
                    <span class="font-size-card light-blue-text text-darken-3">
                        {{preg_replace('/\D/','',$job->NumberOfPosition)}}
                    </span>
                    <br>
                    <span class=" light-blue-text text-lighten-3 ">
                        อัตรา
                    </span>
                </div>
                <div class="col s6 m3 center-align icon-card-layout">
                    <i class="material-icons rcorners-icons small z-depth-1">
                        perm_identity
                    </i>
                    <br>
                    <span class="font-size-card light-blue-text text-darken-3">
                        {{$job->apply_count}}
                    </span>
                    <br>
                    <span class="light-blue-text text-lighten-3 ">
                        ผู้สมัคร
                    </span>
                </div>
                <div class="col s6 m3 center-align icon-card-layout">
                    <i class="material-icons rcorners-icons small z-depth-1">
                        visibility
                    </i>
                    <br>
                    <span class="font-size-card light-blue-text text-darken-3">
                        {{$job->view_count}}
                    </span>
                    <br>
                    <span class="light-blue-text text-lighten-3 ">
                        ผู้เข้าดูงาน
                    </span>
                </div>
                <div class="col s6 m3 center-align icon-card-layout">
                    <i class="material-icons rcorners-icons small z-depth-1">
                        search
                    </i>
                    <br>
                    <span class="font-size-card light-blue-text text-darken-3">
                        {{$job->ReloadCount}}
                    </span>
                    <br>
                    <span class="light-blue-text text-lighten-3 ">
                        การค้นหางาน
                    </span>
                </div>
            </div>
        </div>
        <div class="card-action right-align s12">
            <a class="jobDetail" id = "jobDetail{{$i}}" href="/company/{{$company}}/job/{{$job->RunningNumber}}">
                ดูรายละเอียดงาน
            </a>
            <a class="jobApply" id = "jobApply{{$i}}" href="/company/{{$company}}/job/{{$job->RunningNumber}}/resumes">
                ดูผู้สมัคร/ผู้สนใจ<span class="hide-on-small-only">/ผู้เข้าดูงาน</span>
            </a>
        </div>
    </div>
</div>
{{--*/$i++/*--}}
@endforeach
<input type="hidden" id="lastpage" value="{{$jobs->lastPage()}}">

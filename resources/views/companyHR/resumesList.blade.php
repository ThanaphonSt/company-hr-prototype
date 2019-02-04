{{--*/$i = 0/*--}}
@foreach($resumes as $resume)
<div class="col s12 no-padding">
    <section class="card horizontal row hoverable">
        <div class="col s12 m3 l2 small-padding">
            <div class="col s12">
                <p>
                    <span class = "font-size content-card-left hide-on-small-only">
                        resume &nbsp
                    </span>
                    <span class = "font-size content-card-left">
                        score
                    </span> 
                    <span class = "font-size content-card-right">
                        {{$resume->resumes->Resume_Score_Percent}}%
                    </span>
                </p>
            </div>
            <div class="progress">
                <div class="determinate orange accent-2 center-align" style="width:{{$resume->resumes->Resume_Score_Percent}}%;">
                </div>
            </div>
            <div class="col s12">
                <center>
                    @if ($resume->resumes->Gender == trans('messages.male'))
                    <img class=" z-depth-1" src="http://www.jobthai.com/service/resume_image.php?code={{$resume->resumes->RunningNumber}}&gender=m&size=l&unlock=">
                    @elseif ($resume->resumes->Gender == trans('messages.female'))
                    <img class=" z-depth-1" src="http://www.jobthai.com/service/resume_image.php?code={{$resume->resumes->RunningNumber}}&gender=f&size=l&unlock=">
                    @endif
                </center>
            </div>
            <div class="row">
                <p class="col s12 no-margin">
                    <span class="font-size content-card-left icon-gender" >
                        @if ($resume->resumes->Gender == trans('messages.male'))
                        <i class="fa fa-mars" aria-hidden="true"></i>
                        @elseif ($resume->resumes->Gender == trans('messages.female'))
                        <i class="fa fa-venus" aria-hidden="true"></i>
                        @endif
                    </span>
                    <span class = "font-size content-card-right">
                        @if($resume->resumes->DOB != "")
                        {{Carbon\Carbon::parse($resume->resumes->DOB)->age}} ปี
                        @else
                        ไม่มีข้อมูล
                        @endif
                    </span>
                </p>
            </div>
        </div>
        <div class="card-stacked card-content font-size col m9 s12 card-content-layout">
            <div class="s12">
                <span class="gray-text text-darken-2 col s12 m10 position-layout">
                    <b>ตำแหน่งที่ต้องการ : </b> 
                    <span class="font-style">
                        @if($resume->resumes->Position1 != "")
                            {{$resume->resumes->Position1}}
                        @else
                            ไม่ระบุ
                        @endif
                        @if($resume->resumes->Position2 != "")
                            / {{$resume->resumes->Position2}}
                        @endif
                        @if($resume->resumes->Position3 != "")
                            / {{$resume->resumes->Position3}}
                        @endif
                        </span>
                </span>
                <span class ="col s2 content-card-right hide-on-small-only grey-text right-align">
                    {{Carbon\Carbon::parse($resume->CreateDate)->format('d-m-')}}{{(Carbon\Carbon::parse($resume->CreateDate)->format('Y')+543)}}
                </span>
            </div>
            <div class="col s12">
                <div class="row">
                    <hr class="hide-on-small-only">
                    <div class="col s12 m6">
                        <span>
                            <b>จังหวัด :</b> {{$resume->resumes->province}}
                        </span>
                    </div>
                    <div class="col s12 m6">
                        <span><b>เงินเดือน :</b> {{$resume->resumes->SalaryMin}} - {{$resume->resumes->SalaryMax}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6">
                        <span><b>ระดับการศึกษา :</b> 
                            @if ($resume->resumes->Grad1_Degree == "")
                            ไม่ระบุ
                            @elseif ($resume->resumes->Grad1_Degree != "")
                            {{$resume->resumes->Grad1_Degree}}
                            @endif
                        </span>
                    </div>
                    <div class="col s12 m6">
                        <span>
                            <b>สาขา :</b> @if ($resume->resumes->Grad1_Field == "")
                            ไม่ระบุ
                            @elseif ($resume->resumes->Grad1_Field != "")
                            {{$resume->resumes->Grad1_Field}}
                            @endif
                        </span>
                    </div>     
                </div>
                <div class="row">
                    <div class="col s12 position-layout">
                        <span> 
                            <b>ชื่อสถานศึกษา :</b>
                            @if ($resume->resumes->Grad1_School == "")
                            ไม่ระบุ
                            @elseif ($resume->resumes->Grad1_School != "")
                            {{$resume->resumes->Grad1_School}}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <span>
                            <b>ตำแหน่งที่เคยทำ :</b> 
                            <span>
                            @if($resume->resumes->History1_Position != "")
                            {{$resume->resumes->History1_Position}}
                            @else
                            ไม่ระบุ
                            @endif
                            @if($resume->resumes->History2_Position != "")
                            / {{$resume->resumes->History2_Position}}
                            @endif
                            @if($resume->resumes->History3_Position != "")
                            / {{$resume->resumes->History3_Position}}
                            @endif
                            </span>
                        </span>
                    </div>
                </div>
                <div class="card-action right-align">
                    <a href="/company/{{$company}}/resume/{{$resume->resumes->RunningNumber}}" id="seemore{{$i}}" class="text-card-action">
                        ดูรายละเอียดประวัติ
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
    {{--*/$i++/*--}}
@endforeach
<input type="hidden" id="lastpage{{$action}}" value="{{$resumes->lastPage()}}">
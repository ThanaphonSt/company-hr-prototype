{{--*/$i = 0/*--}}
@foreach($resumes as $resume)
<div class = "content-list-resume">
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
                            {{$resume->resume->Resume_Score_Percent}}%
                        </span>
                    </p>
                </div>
                <div class="progress col s12">
                    <div class="determinate orange accent-2 center-align" style="width:{{$resume->resume->Resume_Score_Percent}}%;">
                    </div>
                </div>
                <div class="col s12">
                    <center>
                        @if ($resume->resume->Gender == "ช")
                        <img class=" z-depth-1" src="http://www.jobthai.com/service/resume_image.php?code={{$resume->resume->RunningNumber}}$Photo->Gender&gender=m&size=&unlock=">
                        @elseif ($resume->resume->Gender == "ญ")
                        <img class=" z-depth-1" src="http://www.jobthai.com/service/resume_image.php?code={{$resume->resume->RunningNumber}}$Photo->Gender&gender=f&size=&unlock=">
                        @endif
                    </center>
                </div>
                <div class="row">
                    <p class="col s12 no-margin">
                        <span class="font-size content-card-left icon-gender" >
                            @if ($resume->resume->Gender == "ช")
                            <i class="fa fa-mars" aria-hidden="true"></i>
                            @elseif ($resume->resume->Gender == "ญ")
                            <i class="fa fa-venus" aria-hidden="true"></i>
                            @endif
                        </span>
                        <span class = "font-size content-card-right">
                            @if ($resume->resume->Age == "")
                                -  ปี
                            @else
                                {{$resume->resume->Age}}ปี
                            @endif
                        </span>
                    </p>
                </div>
            </div>
            <div class="card-stacked card-content font-size col m9 s12 card-content-layout">
                <div class="m12 s12">
                    <span class="gray-text text-darken-2 col s12 m10 position-layout">
                        <b>ตำแหน่งที่ต้องการ : </b> <span class="font-style">
                        @if($resume->resume->Position1 != "")
                        {{$resume->resume->Position1}} {{$resume->resume->Position2}} {{$resume->resume->Position3}} 
                        @else
                        ไม่ระบุ
                        @endif</span>
                    </span>
                    <span class ="col s2 content-card-right hide-on-small-only grey-text right-align">
                        {{ Carbon\Carbon::parse($resume->CreateDate)->format('d-m-Y') }}
                    </span>
                </div>
                <div class="col s12">
                    <div class="row">
                        <hr class="hide-on-small-only">
                        <div class="col s12 m6">
                            <span>
                                <b>จังหวัด :</b> {{$resume->resume->province}}
                            </span>
                        </div>
                        <div class="col s12 m6">
                            <span>
                                <b>เงินเดือน :</b> {{$resume->resume->SalaryMin}} - {{$resume->resume->SalaryMax}}
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6">
                            <span>
                                <b>ระดับการศึกษา :</b> 
                                @if ($resume->resume->Grad1_Level == "")
                                ไม่ระบุ
                                @elseif ($resume->resume->Grad1_Level != "")
                                {{$resume->resume->Grad1_Level}}
                                @endif
                            </span>
                        </div>
                        <div class="col s12 m6">
                            <span>
                                <b>สาขา :</b> 
                                @if ($resume->resume->Grad1_Field == "")
                                ไม่ระบุ
                                @elseif ($resume->resume->Grad1_Field != "")
                                {{$resume->resume->Grad1_Field}}
                                @endif
                            </span>
                        </div>     
                    </div>
                    <div class="row">
                        <div class="col s12 position-layout">
                            <span> 
                                <b>ชื่อสถานศึกษา :</b>
                                @if ($resume->resume->Grad1_School == "")
                                ไม่ระบุ
                                @elseif ($resume->resume->Grad1_School != "")
                                {{$resume->resume->Grad1_School}}
                                @endif
                            </span>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col s12">
                            <span>
                                <b>ตำแหน่งที่เคยทำ :</b> 
                                @if($resume->resume->History1_Position != "")
                                    {{$resume->resume->History1_Position}}
                                    @else
                                    ไม่ระบุ
                                    @endif
                                    @if($resume->resume->History2_Position != "")
                                    / {{$resume->resume->History2_Position}}
                                    @endif
                                    @if($resume->resume->History3_Position != "")
                                    / {{$resume->resume->History3_Position}}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="card-action right-align">
                    <a href="/company/{{$company}}/resume/{{$resume->resume->RunningNumber}}" id="seemore{{$i}}" class="text-card-action">
                        ดูรายละเอียดประวัติ
                    </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{--*/$i++/*--}}
@endforeach
<input type="hidden" id="total" value="{{$resumes->lastPage()}}">
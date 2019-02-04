@extends('companyHR.layout')
@section('title','รายละเอียดประวัติ')
@section('link')
<link type="text/css" rel="stylesheet" href="{{asset('/companyHR/css/resumeDetail.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('/font-awesome/css/font-awesome.min.css')}}"/>
@endsection
@section('brand')
<div class="brand-size truncate">
รายละเอียดประวัติ
</div>
@endsection
@section('content')

<div id="modal1" class="modal middle">
    <div class="modal-content ">
        <div id="pdf"></div>
    </div>
</div>
<div class="card from">
    <div class="card-panel grey lighten-5 z-depth-1 content-layout">
        <div class="fixed-action-btn horizontal btn-fix hide-on-small-only">
            <li class="btn-floating btn-large red center">
                <a class="modal-trigger " href="#modal1" id="export">
                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                </a>
            </li>
        </div>
        <div class="row">
            <div class="col s12 m4">
                <div class="row">
                    <div class="card-image col s12">
                        <div class="row center">
                            @if ($resume->Gender == "ช")
                            <img class=" z-depth-1 materialboxed" id = "photoProfile" src="http://www.jobthai.com/service/resume_image.php?code={{$resume->RunningNumber}}&gender=m&size=l&unlock=">
                            @elseif ($resume->Gender == "ญ")
                            <img class=" z-depth-1 materialboxed" id = "photoProfile" src="http://www.jobthai.com/service/resume_image.php?code={{$resume->RunningNumber}}&gender=f&size=l&unlock=">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row card-content" id ="contact">
                    <ul>
                        <li class="header col s12"> 
                            <font color="orange" class="font-size-header">
                                ข้อมูลการติดต่อ
                            </font>
                        </li>
                    </ul>
                </div>
                <div class="hide-on-large-only row"> 
                    <ul>
                        <i class="Tiny material-icons col s1">
                            person
                        </i>
                        <span class="col s11">
                            {{$resume->FirstName}}
                            {{$resume->LastName}}
                        </span>
                    </ul>
                </div>
                <div class="row">	
                    <ul>
                        <i class="Tiny material-icons col s1">
                            call
                        </i>
                        <span class="col s11">
                            @if($resume->Tel != "")
                            {{$resume->Tel}}
                            @else
                            ไม่มีข้อมูล
                            @endif
                        </span>
                    </ul>
                </div> 
                <div class="row">			
                    <ul>
                        <i class="Tiny material-icons col s1">
                            email
                        </i>
                        <span class="col s11">
                            @if($resume->Email != "")
                            {{$resume->Email}}
                            @else
                            ไม่มีข้อมูล
                            @endif
                        </span>
                    </ul>
                </div>
                <div class="row card-content-bottom">      
                    <ul>
                        <i class="Tiny material-icons col s1">
                            location_on
                        </i>
                        <span class="col s11">
                            @if($resume->Address != "")
                            {{$resume->Address}} {{$resume->area}}
                            @else
                            ไม่มีข้อมูล
                            @endif
                        </span>
                    </ul>
                </div>
            </div>
            <div class="col s12 m8 white no-padding"> 
                <div class="row">
                    <div class="col s12 no-padding">
                        <ul class="tabs ">
                            <li class="tab col s4 hoverable ">
                                <a data-toggle="tab" href="#profile" class="font-color-tabs" id="profileDetail">
                                    <span>ข้อมูล</span><span class="hide-on-small-only">ส่วน</span><span>บุคคล</span>
                                </a>
                            </li>
                            <li class="tab col s4 hoverable">
                                <a data-toggle="tab" href="#education" class="font-color-tabs" id="educationDetail">
                                    ประสบการณ์
                                </a>
                            </li>
                            <li class="tab col s4 hoverable">
                                <a data-toggle="tab" href="#graph" class="font-color-tabs" id="graphDetail">
                                    <span class="hide-on-small-only">ดูในรูปแบบ</span><span>กราฟ</span>
                                </a>
                            </li>    
                        </ul>
                    </div> 
                </div>
            </div>
            <div class="tab-content col s12 m8 " id="profile">
                <div  class="tab-pane fade in active">
                    <div class="row">     
                        <ul>
                            <li class="header">
                                <i class="small material-icons col s1">
                                    perm_identity
                                </i>
                                <font color="orange" class="col s11 font-size-header">
                                    ข้อมูลส่วนบุคคล
                                </font>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class ="row content-padding-top">
                            <div class="col s5 m6" id = "name"> 
                                <b>ชื่อ</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->FirstName != "")
                                    {{$resume->FirstName}}    {{$resume->LastName}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>ส่วนสูง</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->Height != "")
                                    {{$resume->Height}} ซม.
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>น้ำหนัก</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->Weight !="")
                                    {{$resume->Weight}} ก.ก.
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>วันเกิด</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->DOB != "")
                                    {{$resume->thaidate}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>     	
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>อายุ</b> 
                            </div>
                            <div class="col s7 m6">
                                <span >
                                    @if($resume->DOB != "")
                                    {{Carbon\Carbon::parse($resume->DOB)->age}} ปี
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6">
                                <b>เพศ</b>
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if ($resume->Gender == "ช")
                                    ชาย
                                    @elseif ($resume->Gender == "ญ")
                                    หญิง
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">     
                        <ul>
                            <li class="header">
                                <i class="small material-icons col s1 m1">  
                                    assignment
                                </i>  
                                <font color="orange" class="col s11 m11 font-size-header">
                                    ลักษณะงานที่ต้องการ
                                </font>
                            </li>
                        </ul>   
                    </div>
                    <div class="col s12">
                        @if($resume->JobType1 !="")
                        <h6>ตำแหน่งงานที่ต้องการ</h6>
                        <div class="row">
                            <div class="col s12"> 
                                <span>
                                    -&nbsp &nbsp{{$resume->JobType1}}
                                </span> 
                            </div>
                        </div>
                        @else
                        <p class="center-align">
                            ไม่มีข้อมูลลักษณะงานที่ต้องการ
                        </p>
                        @endif
                        @if($resume->JobType2 != "")
                        <div class="row">
                            <div class="col s12"> 
                                <span>
                                    -&nbsp &nbsp{{$resume->JobType2}}
                                </span> 
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class ="row content-padding-top">
                            <div class="col s5 m6"> 
                                <b>รายได้ที่ต้องการ</b> 
                            </div>
                            <div class="col s6">
                                <span>
                                    {{$resume->SalaryMin}} - {{$resume->SalaryMax}} {{$resume->SalaryCurrency}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>สถานที่ต้องการทำงาน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->Work_Place}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5  m6"> 
                                <b>ประเภทงานที่ต้องการ</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->JobType_Fulltime == "1")
                                    พนักงานประจำ
                                    @endif

                                    @if($resume->JobType_Parttime == "1")
                                    ทำงานนอกเวลา
                                    @endif

                                    @if($resume->JobType_Freelance == "1")
                                    รับจ้างอิสระ
                                    @endif

                                    @if($resume->JobType_Intern == "1")
                                    ฝึกงาน
                                    @endif

                                    @if($resume->JobType_Fulltime == "0" && $resume->JobType_Parttime == "0" && $resume->JobType_Freelance == "0" && $resume->JobType_Intern == "0")
                                    ไม่ระบุ
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>วันที่สามารถเริ่มงานได้</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->StartWorkDate}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <ul>     
                            <li class="header">
                                <i class="small material-icons col s1">
                                    library_books
                                </i>
                                <font color="orange" class="col s11 font-size-header">
                                    ความสามารถ ผลงาน
                                </font>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        @if($resume->Attr1 != "")
                        <div class="col s12">
                            <span>
                                -&nbsp &nbsp{{$resume->Attr1}}
                            </span>
                        </div>
                        @else
                        <p class="center-align">
                            ไม่มีข้อมูลความสามารถ ผลงาน
                        </p>
                        @endif
                        @if($resume->Attr2 != "")
                        <div class="col s12">
                            <span>
                                -&nbsp &nbsp{{$resume->Attr2}}
                            </span>
                        </div>
                        @endif
                        @if($resume->Attr3 != "")
                        <div class="col s12">
                            <span>
                                -&nbsp &nbsp{{$resume->Attr3}}
                            </span>
                        </div>
                        @endif
                        @if($resume->Attr4 != "")
                        <div class="col s12">
                            <span>
                                -&nbsp &nbsp{{$resume->Attr4}}
                            </span>
                        </div>
                        @endif
                        @if($resume->Attr5 != "")
                        <div class="col s12">
                            <span>
                                -&nbsp &nbsp{{$resume->Attr5}}
                            </span>
                        </div>
                        @endif              
                        <div class="col s12">
                            <h6>
                                โครงการ ผลงาน เกียรติประวัติ และประสบการณ์อื่นๆ
                            </h6>
                        </div>
                        @if($resume->Masterpiece != "")
                        <div class="col s12">
                            <span>
                                &nbsp &nbsp{{$resume->Masterpiece}}
                            </span>
                        </div>
                        @else
                        <p class="center-align col s12">
                            ไม่มีข้อมูลโครงการ ผลงาน เกียรติประวัติ และประสบการณ์อื่นๆ
                        </p>
                        @endif
                    </div>
                </div>
            </div> 
            <div class="tab-content col s12 m8" id="education">
                <div  class="tab-pane fade in active">
                    <div class="row">
                        <ul>     
                            <li class="header">
                                <i class="small material-icons col s1">
                                    library_books
                                </i>
                                <font color="orange" class="col s11 content-padding-bottom font-size-header" id="history_education">
                                    ประวัติการศึกษา
                                </font>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col s12">
                                <span class="light-blue-text text-darken-4">
                                    {{$resume->Grad1_School}}
                                </span>
                                <span class="right">
                                    ปี {{($resume->Grad1_NYear+543)}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5  m6"> 
                                <b>ระดับการศึกษา</b> 
                            </div>
                            <div class="col s7 m6">
                                <span >
                                    @if($resume->Grad1_Degree !="")
                                    {{$resume->Grad1_Degree}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>สาขา</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->Grad1_Field != "")
                                    {{ $resume->Grad1_Field}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>   
                        <div class ="row">
                            <div class="col s5  m6"> 
                                <b>เกรดเฉลี่ย</b> 
                            </div>
                            <div class="col s7 m6">
                                <span >
                                    @if($resume->Grad1_Grade != "")
                                    {{ $resume->Grad1_Grade}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>  
                    </div>
                    @if($resume->Grad2_School != "")
                    <div class="row">
                        <div class=" col s10" >
                            <hr width="120%" COLOR="#4fc3f7">
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col s12">
                            <span class="light-blue-text text-darken-4">
                                {{$resume->Grad2_School}}
                            </span>
                            <span class="right">
                                ปี {{($resume->Grad2_NYear+543)}}
                            </span>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>ระดับการศึกษา</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->Grad2_Degree != "")
                                    {{$resume->Grad2_Degree}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>สาขา</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->Grad2_Field != "")
                                    {{ $resume->Grad2_Field}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>   
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>เกรดเฉลี่ย</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->Grad2_Grade != "")
                                    {{ $resume->Grad2_Grade}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>  
                    </div>
                    @endif
                    @if($resume->Grad3_School != "")
                    <div class="row">
                        <div class=" col s10" >
                            <hr width="120%" COLOR="#4fc3f7">
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col s12">
                            <span class="light-blue-text text-darken-4">
                                {{$resume->Grad3_School}}
                            </span>
                            <span class="right">
                                ปี {{($resume->Grad3_NYear+543)}}
                            </span>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>ระดับการศึกษา</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->Grad3_Degree != "")
                                    {{$resume->Grad3_Degree}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>สาขา</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->Grad3_Field != "")
                                    {{ $resume->Grad3_Field}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>   
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>เกรดเฉลี่ย</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    @if($resume->Grad3_Grade !="")
                                    {{ $resume->Grad3_Grade}}
                                    @else
                                    ไม่มีข้อมูล
                                    @endif
                                </span>
                            </div>
                        </div>  
                    </div>
                    @endif
                    <div class="row">
                        <ul>     
                            <li class="header">
                                <i class="small material-icons col s1">
                                    library_books
                                </i>
                                <font color="orange" class="col s11 font-size-header">
                                    ประวัติการทำงาน/ฝึกงาน
                                </font>
                            </li>
                        </ul>
                    </div>
                    <div class ="row content-padding-top">
                        @if($resume->History1_Company != "")
                        <div class="col s12">
                            <span class="light-blue-text text-darken-4">
                                {{$resume->History1_Company}}
                            </span>
                            <span class="right">
                                ปี {{($resume->History1_From_Year+543)}} -
                                @if($resume->History1_To_Year == "9999")
                                ปัจจุบัน
                                @else
                                {{($resume->History1_To_Year+543)}}
                                @endif
                            </span>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>ตำแหน่ง</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History1_Position}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>เงินเดือน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History1_Salary}}
                                </span>
                            </div>
                        </div>   
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>หน้าที่ ความรับผิดชอบ และผลงาน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History1_Duty}}
                                </span>
                            </div>
                        </div>
                        @else
                        <p class="center-align">
                            ไม่มีข้อมูลประวัติการทำงาน
                        </p>
                        @endif 
                    </div>
                    @if($resume->History2_Company != "")
                    <div class="row">
                        <div class=" col s10" >
                            <hr width="120%" COLOR="#4fc3f7">
                        </div>
                    </div>     
                    <div class ="row">
                        <div class="col s12">
                            <span class="light-blue-text text-darken-4">
                                บริษัท {{$resume->History2_Company}}
                            </span>
                            <span class="right">
                                ปี {{($resume->History2_From_Year+543)}} -
                                @if($resume->History2_To_Year == "9999")
                                ปัจจุบัน
                                @else
                                {{($resume->History2_To_Year+543)}}
                                @endif
                            </span>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>ตำแหน่ง</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History2_Position}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>เงินเดือน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>  
                                    {{$resume->History2_Salary}}
                                </span>
                            </div>
                        </div>   
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>หน้าที่ ความรับผิดชอบ และผลงาน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>  
                                    {{$resume->History2_Duty}}
                                </span>
                            </div>
                        </div>  
                    </div>
                    @endif
                    @if($resume->History3_Company != "")
                    <div class="row">
                        <div class=" col s10" >
                            <hr width="120%" COLOR="#4fc3f7">
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col s12">
                            <span class="light-blue-text text-darken-4">
                                บริษัท {{$resume->History3_Company}}
                            </span>
                            <span class="right">
                                ปี {{($resume->History3_From_Year+543)}} - 
                                @if($resume->History3_To_Year == "9999")
                                ปัจจุบัน
                                @else
                                {{($resume->History3_To_Year+543)}}
                                @endif
                            </span>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>ตำแหน่ง</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History3_Position}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>เงินเดือน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History3_Salary}}
                                </span>
                            </div>
                        </div>   
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>หน้าที่ ความรับผิดชอบ และผลงาน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History3_Duty}}
                                </span>
                            </div>
                        </div>  
                    </div>
                    @endif
                    @if($resume->History4_Company != "")
                    <div class="row">
                        <div class=" col s10" >
                            <hr width="120%" COLOR="#4fc3f7">
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col s12">
                            <span class="light-blue-text text-darken-4">
                                บริษัท {{$resume->History4_Company}}
                            </span>
                            <span class="right">
                                ปี {{($resume->History4_From_Year+543)}} -
                                @if($resume->History4_To_Year == "9999")
                                ปัจจุบัน
                                @else
                                {{($resume->History4_To_Year+543)}}
                                @endif
                            </span>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>ตำแหน่ง</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History4_Position}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>เงินเดือน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History4_Salary}}
                                </span>
                            </div>
                        </div>   
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>หน้าที่ ความรับผิดชอบ และผลงาน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History4_Duty}}
                                </span>
                            </div>
                        </div>  
                    </div>
                    @endif
                    @if($resume->History5_Company != "")
                    <div class="row">
                        <div class=" col s10" >
                            <hr width="120%" COLOR="#4fc3f7">
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col s12">
                            <span class="light-blue-text text-darken-4">
                                บริษัท {{$resume->History5_Company}}
                            </span>
                            <span class="right">
                                ปี {{($resume->History5_From_Year+543)}} -
                                @if($resume->History5_To_Year == "9999")
                                ปัจจุบัน
                                @else
                                {{($resume->History5_To_Year+543)}}
                                @endif
                            </span>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>ตำแหน่ง</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History5_Position}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>เงินเดือน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History5_Salary}}
                                </span>
                            </div>
                        </div>   
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>หน้าที่ ความรับผิดชอบ และผลงาน</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{$resume->History5_Duty}}
                                </span>
                            </div>
                        </div>  
                    </div>
                    @endif
                    <div class="row"> 
                        <ul>     
                            <li class="header">
                                <i class="small material-icons col s1" >
                                    insert_chart
                                </i>
                                <font color="orange" class="col s11 font-size-header">
                                    ประวัติการฝึกอบรม/ประกาศนียบัตร
                                </font>
                            </li>
                        </ul>            
                    </div> 
                    @if($resume->Training1_Course == "")
                    <p class="center-align">
                        ไม่มีประวัติการฝึกอบรม/ประกาศนียบัตร
                    </p>
                    @else
                    <div class="col s12">
                        <div class="right">
                            <span>
                                ปี {{($resume->Training1_From_Year+543)}} -
                                @if($resume->Training1_To_Year == "9999")
                                ปัจจุบัน
                                @else
                                {{($resume->Training1_To_Year+543)}}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class ="row">
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>สถาบัน/หน่วยงาน/บริษัท</b> 
                            </div>
                            <div class="col s7 m6">
                                <span >
                                    {{ $resume->Training1_Institute}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>หลักสูตร</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{ $resume->Training1_Course}}
                                </span>
                            </div>
                        </div>      
                    </div>
                    @endif
                    @if($resume->Training2_Course != "")
                    <div class="row">
                        <div class=" col s10" >
                            <hr width="120%" COLOR="#4fc3f7">
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="right">
                            <span>
                                ปี {{($resume->Training2_From_Year+543)}} -
                                @if($resume->Training2_To_Year == "9999")
                                ปัจจุบัน
                                @else
                                {{($resume->Training2_To_Year+543)}}
                                @endif
                            </span>
                        </div>
                    </div>          
                    <div class ="row">
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>สถาบัน/หน่วยงาน/บริษัท</b> 
                            </div>
                            <div class="col s7 m6">
                                <span >
                                    {{$resume->Training2_Institute}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>หลักสูตร</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{ $resume->Training2_Course}}
                                </span>
                            </div>
                        </div>      
                    </div>
                    @endif
                    @if($resume->Training3_Course != "")
                    <div class="row">
                        <div class="col s10">
                            <hr width="120%" COLOR="#4fc3f7">
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="right">
                            <span>
                                ปี {{($resume->Training3_From_Year+543)}} -
                                @if($resume->Training3_To_Year == "9999")
                                ปัจจุบัน
                                @else
                                {{($resume->Training3_To_Year+543)}}
                                @endif
                            </span>
                        </div>
                    </div>          
                    <div class ="row">
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>สถาบัน/หน่วยงาน/บริษัท</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{ $resume->Training3_Institute}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>หลักสูตร</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{ $resume->Training3_Course}}
                                </span>
                            </div>
                        </div>      
                    </div>
                    @endif
                    @if($resume->Training4_Course != "")
                    <div class="row">
                        <div class=" col s10">
                            <hr width="120%" COLOR="#4fc3f7">
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="right">
                            <span>
                                ปี {{($resume->Training4_From_Year+543)}} -
                                @if($resume->Training4_To_Year == "9999")
                                ปัจจุบัน
                                @else
                                {{($resume->Training4_To_Year+543)}}
                                @endif
                            </span>
                        </div>
                    </div>          
                    <div class ="row">
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>สถาบัน/หน่วยงาน/บริษัท</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{ $resume->Training4_Institute}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>หลักสูตร</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{ $resume->Training4_Course}}
                                </span>
                            </div>
                        </div>      
                    </div>
                    @endif
                    @if($resume->Training5_Course != "")
                    <div class="row">
                        <div class="col s10">
                            <hr width="120%" COLOR="#4fc3f7">
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="right">
                            <span>
                                ปี {{($resume->Training5_From_Year+543)}} - 
                                @if($resume->Training5_To_Year == "9999")
                                ปัจจุบัน
                                @else
                                {{($resume->Training5_To_Year+543)}}
                                @endif
                            </span>
                        </div>
                    </div>          
                    <div class ="row">
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>สถาบัน/หน่วยงาน/บริษัท</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>
                                    {{ $resume->Training5_Institute}}
                                </span>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col s5 m6"> 
                                <b>หลักสูตร</b> 
                            </div>
                            <div class="col s7 m6">
                                <span>  
                                    {{ $resume->Training5_Course}}
                                </span>
                            </div>
                        </div>      
                    </div>
                    @endif
                </div>
            </div>
            <div class="tab-content col s12 m8" id="graph">
                <div class="tab-pane fade in active">
                    <div id ="chart-content" class="row scroll-content">
                        <div id="chart" class="col s11 m12">
                            <div align="center">
                                <div class="preloader preloader-wrapper big active">
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
        </div>
    </div>
</div>
<input type="hidden" id="idResume" value="{{$resume->RunningNumber}}">
@endsection
@section('scriptLink')
<script src="{{ asset('/PDFObject-master/pdfobject.js')}}"></script>
<script src="{{ asset('/chartGoogle/loader.js')}}"></script>
<script src="{{ asset('/companyHR/js/resumeDetail.js')}}"></script>
@endsection
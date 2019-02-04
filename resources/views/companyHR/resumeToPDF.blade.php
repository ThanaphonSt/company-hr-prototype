<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" media="all">
	<link rel="stylesheet" media="all" href="{{ asset('/materialize/css/materialize.css') }}">
	<link media="print" rel="Alternate" href="print.pdf">
	<link href="{{ asset('/materialize/css/Material+Icons.css') }}" media="all" rel="stylesheet">
	<link rel="stylesheet" media="all" href="{{ asset('/font-awesome/css/font-awesome.min.css') }}">
	<meta charset="utf-8">
	<style >
		@page {
			size: 8.27in 11.69in;
		}
		.box{
			width: 8.27in;
			height: 11.69in;
			margin: 0in 0in 0in 0in;
		}
		.name{
			font-weight: black;
		}
		.bold{
			font-weight: bold;
		}
		.profession{
			font-weight: condensed;
		}
		.glyphicon{
			font-size: 24px;
		}
		.left{
			border-right: dashed 1px gray
		}
		.child-box{
			margin-top: 0px;
			margin-bottom: 0px;
			margin-left: 10px;
		}.needjob-title{
			margin-bottom: 0px;
		}
		span.badge.gray {
			font-weight: 300;
			font-size: 0.8rem;
			color: #fff;
			background-color:#212121 ;
			border-radius: 2px;
			right: inherit;
		}
		.row{
			margin-top: 0px;
			margin-bottom: 0px;
		}
		h6{
			font-size: 1.25rem;
		}
        hr{
            size: 2px;
            color: black;
        }
	</style>

</head>

<body>
	<div class="box">
		<div class="row">
                <h3 align = "center" class="bold"> 
                        @if($resume->FirstName != "")
                            {{$resume->FirstName}}    {{$resume->LastName}}
                        @endif
                </h3>
                <br>
            <div class="col s7">                
                    <div>
                        <b>ที่อยู่ </b>: {{$resume->Address}} {{$resume->area}}
                    </div>
                    <div>
                        <b> เบอร์โทรศัพท์:</b>
                        @if($resume->Tel != '')
                            {{$resume->Tel}}
                        @else
                            ไม่มีข้อมูล
                        @endif
                    </div>   
                    <div>
                        <b> E-mail:</b>  
                        @if($resume->Email != "")
                            {{$resume->Email}}
                        @else
                            ไม่มีข้อมูล   
                        @endif
                    </div> 
                    <div>
                        <b>อายุ :</b>
                        @if($resume->DOB != "")
                            {{Carbon\Carbon::parse($resume->DOB)->age}} ปี
                            @else
                            ไม่มีข้อมูล
                        @endif
                    </div>
                    <div>
                        <b>วันเกิด: </b>
                        @if($resume->DOB != "")
                            {{$resume->thaidate}}
                            @else
                            ไม่มีข้อมูล
                        @endif                         
                    </div>
                           
            </div>
            <div class="col s2 offset-s3"> 
                    @if ($resume->Gender == "ช")
                        <img id = "photoProfile" src="http://www.jobthai.com/service/resume_image.php?code={{$resume->RunningNumber}}&gender=m&size=l&unlock=">
                    @elseif ($resume->Gender == "ญ")
                        <img id = "photoProfile" src="http://www.jobthai.com/service/resume_image.php?code={{$resume->RunningNumber}}&gender=f&size=l&unlock=">
                    @endif  
            </div>              
        </div>
        
        <div class="row">
            <div class="col s10">
                <hr width="120%" COLOR="#4fc3f7">
            </div>
            <div class="col s12">
                <div class="row">
                    <h4 class="bold">ลักษณะงานที่ต้องการ</h4>
                </div>
                <div class="col s12">
                    @if($resume->JobType1 != "")
                    <b>ตำแหน่งงานที่ต้องการ</b>
                    <div class="row">
                        <div class="col s12"> 
                            <span>
                                -&nbsp &nbsp{{$resume->JobType1}}
                            </span> 
                        </div>
                    </div>
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
                <div class ="row">
                    <div class="col s5"> 
                        <b>รายได้ที่ต้องการ</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->SalaryMin}} - {{$resume->SalaryMax}} {{$resume->SalaryCurrency}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>สถานที่ต้องการทำงาน</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            @if($resume->Work_Place != "")
                            {{$resume->Work_Place}}
                            @else
                            ไม่มีข้อมูล
                            @endif
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>ประเภทงานที่ต้องการ</b> 
                    </div>
                    <div class="col s7">
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
                    <div class="col s5"> 
                        <b>วันที่สามารถเริ่มงานได้</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->StartWorkDate}}
                        </span>
                    </div>
                </div>
            </div>
            @if($resume->Grad1_School != "")
            <div class=" col s10" >
                <hr width="120%" COLOR="#4fc3f7">
            </div>
            <div class="row">
                <h4 class="bold">ประวัติการศึกษา</h4>
                <div class="row">
                    <div class="col s12">
                        <span>
                            {{$resume->Grad1_School}}
                        </span>
                        <span class="right">
                            ปี {{($resume->Grad1_NYear+543)}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5 "> 
                        <b>ระดับการศึกษา</b> 
                    </div>
                    <div class="col s7">
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
                    <div class="col s5"> 
                        <b>สาขา</b> 
                    </div>
                    <div class="col s7">
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
                    <div class="col s5"> 
                        <b>เกรดเฉลี่ย</b> 
                    </div>
                    <div class="col s7">
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
            @endif
            @if($resume->Grad2_School != "")
            <div class="row">
                <div class=" col s10" >
                    <hr width="120%" COLOR="#4fc3f7">
                </div>
            </div>
            <div class ="row">
                <div class="col s12">
                    <span>
                        {{$resume->Grad2_School}}
                    </span>
                    <span class="right">
                        ปี {{($resume->Grad2_NYear+543)}}
                    </span>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>ระดับการศึกษา</b> 
                    </div>
                    <div class="col s7">
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
                    <div class="col s5"> 
                        <b>สาขา</b> 
                    </div>
                    <div class="col s7">
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
                    <div class="col s5"> 
                        <b>เกรดเฉลี่ย</b> 
                    </div>
                    <div class="col s7">
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
                    <span>
                        {{$resume->Grad3_School}}
                    </span>
                    <span class="right">
                        ปี {{($resume->Grad3_NYear+543)}}
                    </span>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>ระดับการศึกษา</b> 
                    </div>
                    <div class="col s7">
                        <span >
                            @if($resume->Grad3_Degree != "")
                            {{$resume->Grad3_Degree}}
                            @else
                            ไม่มีข้อมูล
                            @endif
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>สาขา</b> 
                    </div>
                    <div class="col s7">
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
                    <div class="col s5"> 
                        <b>เกรดเฉลี่ย</b> 
                    </div>
                    <div class="col s7">
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
            @if($resume->History1_Company != "")
            <div class=" col s10" >
                <hr width="120%" COLOR="#4fc3f7">
            </div>
            <div class="row">
                <ul>     
                    <li class="header">
                        
                        <font class="col s11 font-size-header">
                           <h4 class="bold">ประวัติการทำงาน/ฝึกงาน</h4>
                        </font>
                    </li>
                </ul>
            </div>
            <div class ="row content-padding-top">
                <div class="col s12">
                    <span>
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
                    <div class="col s5"> 
                        <b>ตำแหน่ง</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History1_Position}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>เงินเดือน</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History1_Salary}}
                        </span>
                    </div>
                </div>   
                <div class ="row">
                    <div class="col s5"> 
                        <b>หน้าที่ ความรับผิดชอบ และผลงาน</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History1_Duty}}
                        </span>
                    </div>
                </div>
            </div>
            @endif 
            @if($resume->History2_Company != "")
            <div class="row">
                <div class=" col s10" >
                    <hr width="120%" COLOR="#4fc3f7">
                </div>
            </div>     
            <div class ="row">
                <div class="col s12">
                    <span>
                        บริษัท {{$resume->History2_Company}}
                    </span>
                    <span class="right">
                        ปี {{($resume->History2_From_Year+543)}}-{{($resume->History2_To_Year+543)}}
                    </span>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>ตำแหน่ง</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History2_Position}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>เงินเดือน</b> 
                    </div>
                    <div class="col s7">
                        <span>  
                            {{$resume->History2_Salary}}
                        </span>
                    </div>
                </div>   
                <div class ="row">
                    <div class="col s5"> 
                        <b>หน้าที่ ความรับผิดชอบ และผลงาน</b> 
                    </div>
                    <div class="col s7">
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
                    <span >
                        บริษัท {{$resume->History3_Company}}
                    </span>
                    <span class="right">
                        ปี {{($resume->History3_From_Year+543)}}-{{($resume->History3_To_Year+543)}}
                    </span>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>ตำแหน่ง</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History3_Position}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>เงินเดือน</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History3_Salary}}
                        </span>
                    </div>
                </div>   
                <div class ="row">
                    <div class="col s5"> 
                        <b>หน้าที่ ความรับผิดชอบ และผลงาน</b> 
                    </div>
                    <div class="col s7">
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
                    <span>
                        บริษัท {{$resume->History4_Company}}
                    </span>
                    <span class="right">
                        ปี {{($resume->History4_From_Year+543)}}-{{($resume->History4_To_Year+543)}}
                    </span>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>ตำแหน่ง</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History4_Position}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>เงินเดือน</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History4_Salary}}
                        </span>
                    </div>
                </div>   
                <div class ="row">
                    <div class="col s5"> 
                        <b>หน้าที่ ความรับผิดชอบ และผลงาน</b> 
                    </div>
                    <div class="col s7">
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
                    <span>
                        บริษัท {{$resume->History5_Company}}
                    </span>
                    <span class="right">
                        ปี {{($resume->History5_From_Year+543)}}-{{($resume->History5_To_Year+543)}}
                    </span>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>ตำแหน่ง</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History5_Position}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>เงินเดือน</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History5_Salary}}
                        </span>
                    </div>
                </div>   
                <div class ="row">
                    <div class="col s5"> 
                        <b>หน้าที่ ความรับผิดชอบ และผลงาน</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{$resume->History5_Duty}}
                        </span>
                    </div>
                </div>  
            </div>
            @endif
            <div>                
            </div>
            @if($resume->Attr1 != "")
            <div class=" col s10" >
                <hr width="120%" COLOR="#4fc3f7">
            </div>
            <div class="row">
                <h4 class="bold">ความสามารถ ผลงาน</h4>
            </div>
            @endif
            <div class="row">
                @if($resume->Attr1 != "")
                <div class="col s12">
                    <span>
                        -&nbsp &nbsp{{$resume->Attr1}}
                    </span>
                </div>
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
                @if($resume->Masterpiece != "")
                <div class=" col s10" >
                    <hr width="120%" COLOR="#4fc3f7">
                </div>                 
                <div class="col s12">
                    <h4 class="bold">
                        โครงการ ผลงาน เกียรติประวัติ และประสบการณ์อื่นๆ
                    </h4>
                </div>
                <div class="col s12">
                    <span>
                        &nbsp &nbsp{{$resume->Masterpiece}}
                    </span>
                </div>
                @endif
            </div>
            @if($resume->Training1_Course != "") 
            <div class="row">
                <div class=" col s10" >
                    <hr width="120%" COLOR="#4fc3f7">
                </div>
                <ul>     
                    <li class="header">                        
                        <font  class="col s11 font-size-header">
                           <h4 class="bold">ข้อมูลการอบรม </h4>
                        </font>
                    </li>
                </ul>            
            </div> 
            <div class="col s12">
                <div class="right">
                    <span>
                        ปี {{($resume->Training1_From_Year+543)}}-{{($resume->Training1_To_Year+543)}}
                    </span>
                </div>
            </div>
            <div class ="row">
                <div class ="row">
                    <div class="col s5"> 
                        <b>สถาบัน/หน่วยงาน/บริษัท</b> 
                    </div>
                    <div class="col s7">
                        <span >
                            {{ $resume->Training1_Institute}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>หลักสูตร</b> 
                    </div>
                    <div class="col s7">
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
                        ปี {{($resume->Training2_From_Year+543)}}-{{($resume->Training2_To_Year+543)}}
                    </span>
                </div>
            </div>          
            <div class ="row">
                <div class ="row">
                    <div class="col s5"> 
                        <b>สถาบัน/หน่วยงาน/บริษัท</b> 
                    </div>
                    <div class="col s7">
                        <span >
                            {{ $resume->Training2_Institute}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>หลักสูตร</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{ $resume->Training2_Course}}
                        </span>
                    </div>
                </div>      
            </div>
            @endif
            @if($resume->Training3_Course != "")
            <div class="row">
                <div class=" col s10" >
                    <hr width="120%" COLOR="#4fc3f7">
                </div>
            </div>
            <div class="col s12">
                <div class="right">
                    <span>
                        ปี {{($resume->Training3_From_Year+543)}}-{{($resume->Training2_To_Year+543)}}
                    </span>
                </div>
            </div>          
            <div class ="row">
                <div class ="row">
                    <div class="col s5"> 
                        <b>สถาบัน/หน่วยงาน/บริษัท</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{ $resume->Training3_Institute}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>หลักสูตร</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{ $resume->Training3_Course}}
                        </span>
                    </div>
                </div>      
            </div>
            @endif
            @if($resume->Training4_Course != "")
            <div class="row">
                <div class=" col s10" >
                    <hr width="120%" COLOR="#4fc3f7">
                </div>
            </div>
            <div class="col s12">
                <div class="right">
                    <span>
                        ปี {{($resume->Training4_From_Year+543)}}-{{($resume->Training2_To_Year+543)}}
                    </span>
                </div>
            </div>          
            <div class ="row">
                <div class ="row">
                    <div class="col s5"> 
                        <b>สถาบัน/หน่วยงาน/บริษัท</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{ $resume->Training4_Institute}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>หลักสูตร</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{ $resume->Training4_Course}}
                        </span>
                    </div>
                </div>      
            </div>
            @endif
            @if($resume->Training5_Course != "")
            <div class="row">
                <div class=" col s10" >
                    <hr width="120%" COLOR="#4fc3f7">
                </div>
            </div>
            <div class="col s12">
                <div class="right">
                    <span>
                        ปี {{($resume->Training5_From_Year+543)}}-{{($resume->Training2_To_Year+543)}}
                    </span>
                </div>
            </div>          
            <div class ="row">
                <div class ="row">
                    <div class="col s5"> 
                        <b>สถาบัน/หน่วยงาน/บริษัท</b> 
                    </div>
                    <div class="col s7">
                        <span>
                            {{ $resume->Training5_Institute}}
                        </span>
                    </div>
                </div>
                <div class ="row">
                    <div class="col s5"> 
                        <b>หลักสูตร</b> 
                    </div>
                    <div class="col s7">
                        <span>  
                            {{ $resume->Training5_Course}}
                        </span>
                    </div>
                </div>      
            </div>
            @endif
            </div>
        </div>
    </div>	
</body>
</html>
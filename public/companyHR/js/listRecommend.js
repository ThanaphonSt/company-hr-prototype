$( document ).ready(function() {
    var jobid = $("#jobId").val();
    $.ajax({
        type: "GET",
        url: '/job/'+jobid+'/resumeRecommendFormJob', 
        dataType : "json",

    success: function(response) {
        $("#prograss").hide();
        $.each(response.resume.data, function(index, resume) {
            $.ajax({
                type: "GET",
                url:  '/recommend/'+resume._source.provincecode,
                success:function(response){
                    var gender ='';
                    var icon_gender = '';
                    if (resume._source.gender == "M"){
                        gender = '<img class=" z-depth-1" src="http://www.jobthai.com/service/resume_image.php?code='+resume._source.runningnumber+'&gender=m&size=l&unlock=">';
                        icon_gender = ' <i class="fa fa-mars" aria-hidden="true"></i>';
                    }else if(resume._source.gender == "F"){
                        gender = '<img class=" z-depth-1" src="http://www.jobthai.com/service/resume_image.php?code='+resume._source.runningnumber+'&gender=f&size=l&unlock=">';
                        icon_gender = '<i class="fa fa-venus" aria-hidden="true"></i>';
                    }
                    
                    var position = ''; 
                    if(resume._source.position1||resume._source.position2||resume._source.position3 != ""){
                        if(typeof resume._source.position1 != "undefined"){
                            position = resume._source.position1;
                        }
                        if(typeof resume._source.position2 != "undefined"){
                            position = position+','+resume._source.position2;
                        }
                        if(typeof resume._source.position3 != "undefined"){
                            position = position+','+resume._source.position3;
                        }
                             
                        }else {
                            position = 'ไม่ระบุ';
                    }
                        
                    var school;                          
                    if(resume._source.graduation[0].school != null){
                        school = resume._source.graduation[0].school;
                    }else{
                        school = 'ไม่ระบุ';
                    }

                    var major;
                    if(resume._source.graduation[0].field != null){
                        major = resume._source.graduation[0].field ;
                    }else{
                        major = 'ไม่ระบุ';
                    }

                    var degree;
                    if(resume._source.graduation[0].degree  != null){
                        degree = resume._source.graduation[0].degree ;
                    }else{
                        degree = 'ไม่ระบุ';
                    }
                   
                    var work;
                    var work_ex;             
                    $.each(resume._source.working_experience,function(index,work_experience){
                            work = work+"  "+work_experience.jobposition; 
                            work = work.replace("undefined"," ");
                        }            
                    );

                    var fulldate = new Date(resume._source.lastupdateex);
                    var date = fulldate.getDate()+"-"+(fulldate.getMonth()+1)+"-"+(fulldate.getFullYear()+543);
                
                    var salarymin = "0";
                    var salarymax = "0";
                    var salary = "0";
                    if(typeof resume._source.salarymin && typeof resume._source.salarymax !="undefined"){                   
                        if(typeof resume._source.salarymin != "undefined"){
                            salarymin = resume._source.salarymin;
                        }
                        if(typeof resume._source.salarymax != "undefined"){
                            salarymax = resume._source.salarymax;
                        }
                            salary = salarymin +"-"+ salarymax;
                    }else{
                            salary = "ไม่ระบุ"
                    }

                    var dob = new Date(resume._source.dob);
                    var today = new Date();
                    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                     
                    var companyId = $("#companyId").val();

                    $('#recommend').append('<div class = "content-list-resume">'
                        +'<div class="col s12 no-padding">'
                            +'<section class="card horizontal row hoverable">'
                                +'<div class="col s12 m3 l2 small-padding">'
                                    +'<div class="col s12">'
                                       +' <p>'
                                            +' <span class = "font-size content-card-left hide-on-small-only">'
                                                +' resume &nbsp'
                                            +'  </span>'
                                            +' <span class = "font-size content-card-left">'
                                                +' score'
                                            +'  </span> '
                                            +' <span class = "font-size content-card-right">'
                                                +' '+parseInt(resume._source.resume_score_percent)+'%'
                                            +' </span>'
                                        +'  </p>'
                                    +'  </div>'
                                    +'  <div class="progress col s12">'
                                        +'  <div class="determinate orange accent-2 center-align" style="width:'+resume._source.resume_score_percent+'%;">'
                                        +'  </div>'
                                    +'  </div>'
                                    +' <div class="col s12">'
                                        +'  <center>'                   
                                            +gender                   
                                        +'  </center>'
                                    +'  </div>'
                                    +'  <div class="row">'
                                        +' <p class="col s12 no-margin">'
                                            +'<span class="font-size content-card-left icon-gender" >'
                                                +icon_gender 
                                            +' </span>'
                                            +' <span class = "font-size content-card-right">'                                      
                                                +age+" ปี"
                                            +'</span>'
                                        +'</p>'
                                    +'</div>'
                                +'</div>'
                                +'<div class="card-stacked card-content font-size col m9 s12 card-content-layout">'
                                    +' <div class="m12 s12">'
                                        +'  <span class="gray-text text-darken-2 col s12 m10 position-layout">'
                                            +'<b>ตำแหน่งที่ต้องการ : </b> <span class="font-style">'
                                                +position
                                            +'</span> '
                                        +' </span> '
                                        +' <span class ="col s2 content-card-right hide-on-small-only grey-text right-align">'
                                            +date
                                        +' </span>'
                                    +' </div>'
                                    +' <div class="col s12">'
                                        +'<div class="row">'
                                           +' <hr class="hide-on-small-only">'
                                           +' <div class="col s12 m6">'
                                                +'  <span>'
                                                    +' <b>จังหวัด :</b> '
                                                    +response.province.replace("จังหวัด","")
                                                 +' </span>'
                                            +'</div>'
                                            +' <div class="col s12 m6">'
                                               +' <span>'
                                                    +' <b>เงินเดือน :</b> '
                                                    +salary
                                                +'</span>'
                                            +'</div>'
                                        +'</div>'
                                        +' <div class="row">'
                                            +'<div class="col s12 m6">'
                                                +'<span>'
                                                    +'<b>ระดับการศึกษา :</b> '
                                                    +degree 
                                                +'</span>'
                                            +' </div>'
                                            +' <div class="col s12 m6">'
                                                +'<span>'
                                                    +' <b>สาขา :</b> '
                                                    +major
                                                +' </span>'
                                            +' </div> '    
                                        +' </div>'
                                        +'<div class="row">'
                                            +'<div class="col s12 position-layout">'
                                                +'<span> '
                                                   +' <b>ชื่อสถานศึกษา :</b>'
                                                        +school
                                                +'</span>'
                                            +'</div>'
                                        +'</div>   '
                                        +'<div class="row">'
                                            +'<div class="col s12">'
                                                +'<span>'
                                                    +' <b>ตำแหน่งที่เคยทำ :</b> '
                                                        +work
                                                +'</span>'
                                            +' </div>'
                                        +'</div>'
                                        +'<div class="card-action right-align">'
                                            +'<a id="recommend'+resume._source.runningnumber+'" href="/company/'+companyId +'/resume/'+resume._source.runningnumber+'" id="seemore{{$i}}" class="text-card-action">'
                                                +'ดูรายละเอียดประวัติ'
                                        +' </a>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                           +' </section>'
                        +'</div>'
                    +'</div>')

                    }
                });
            
            });
        }
    });
    
});
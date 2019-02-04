<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>@yield('title')</title>
    <style type="text/css">
    .side-nav{
        width: 240px;
    }
        header, main, footer {
            padding-left: 240px;
        }
        @media only screen and (max-width : 992px) {
            header, main, footer {
                padding-left: 0;
            }
            a.page-title {
                font-size: 36px;
            }
            nav .nav-wrapper {
                text-align: center;
            }
        }
        .page-title{
            font-size:48px; 
        }
        nav{
            height: 122px;
        }
        .middle-nav{
            padding-top: 25px;
        }
        .container{
            margin-right: 100px;
            margin-left: 40px;
        }.userView{
         padding-top: 150px !important;
         padding-left: 0px !important;
        }
    div.background {
  background: url(klematis.jpg) repeat;
  border: 2px solid black;
        }

div.transbox {
  background:rgba(0,0,0,0.5) !important;
  background-color :black;
}

div.transbox a {
  font-weight: bold;
  color: #000000;
}
    @yield('style')
</style>
</head>
<body >
    <ul id="slide-out" class="side-nav fixed">
        <li><div class="userView" style="height:200px">
            <img class="background" style ="height:200px; width:240px;" src="http://study.com/cimages/course-image/human-resource-management-help-course_129634_large.jpg">
            <div class="transbox hoverable" style="width:240px;">
            <a class ="waves-effect waves-light tooltipped" data-position="right" data-delay="50" data-tooltip="{{$companyName->CompanyName}}" href="#!name"><span style="font-size:16px ; " class=" white-text truncate " >{{$companyName->CompanyName}}</span></a>
            </div>
        </div></li>
        <ul class="collapsible" data-collapsible="accordion">

        @foreach($jobs as $job)
        <li class="no-padding">
         <li>
            <div class="collapsible-header truncate waves-effect waves-orange grey-text text-darken-3 tooltipped" style="font-size:12px"> {{$job->JobTitle}}</div>
            <div class="collapsible-body">
                <ul>
                <li><a href="#!" class="waves-effect waves-orange grey-text text-darken-3" style="font-size:12px">รายละเอียดงาน</a></li>
                <li><a href="#!" class="waves-effect waves-orange grey-text text-darken-3" style="font-size:12px">ผู้สมัคร/ผู้ชื่นชอบ/ผู้ชม</a></li>
              </ul>
            </div>
         </li>
        @endforeach
          </ul>
    </ul>
    <header>
        <nav class="middle-nav light-blue darken-3">
            <div class="container">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                <div class="nav-wrapper"><a class="page-title">@yield('brand')</a></div>
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="page-footer   light-blue darken-3">
       
        <div class="footer-copyright light-blue darken-3">
            <div class="container">
                © 2014 Copyright Text
                <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
        </div>
    </footer>
    @yield('scriptLink')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".button-collapse").sideNav();
            $('.tooltipped').tooltip({delay: 50});
            $('.collapsible').collapsible({
            accordion : false});
        });
    </script> 
        @yield('script')
</body>
</html>
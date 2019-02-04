<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link href="{{ asset('/materialize/css/Material+Icons.css') }}" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="{{ asset('/materialize/css/materialize.css') }}" media="screen,projection"/>
        <link href="{{ asset('/MaterialDesignIcon/css/materialdesignicons.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="{{ asset('/companyHR/css/layout.css') }}"/>
        <link rel="stylesheet" media="all" href="{{ asset('/font-awesome/css/font-awesome.min.css') }}">
        @yield('link')
    </head>
    <body> 
    <div class="logout">
        <a href="/logout" class="white-text" id="logout">
            <i class="mdi mdi-logout mdi-24px "></i>
        </a>
    </div>
        <ul id="slide-out" class="side-nav fixed">
            <li>
                <div class="userView z-depth-1">
                    <img class="background image-size" src="http://study.com/cimages/course-image/human-resource-management-help-course_129634_large.jpg">
                    <div class="transbox hoverable companyName-layout ">
                        <a class ="waves-effect waves-light " data-position="right" data-delay="50" data-tooltip="{{$company->CompanyName}}" href="/company/{{$company->RunningNumber}}" id="titleCompany">
                            <span class="companyName-font-size white-text truncate " >
                                {{$company->CompanyName}}
                            </span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="light-blue darken-3 z-depth-1 border">
                <span class="white-text title-menu">
                    งานที่เปิดรับสมัคร
                </span>
            </li>
            <ul class="collapsible" data-collapsible="accordion">
            {{--*/$n = 0/*--}}
            @foreach($jobs as $j)
            @if($active === 'j'.$j->RunningNumber || $active === 'a'.$j->RunningNumber)
                <li class="active">
            @else
                <li class="">
            @endif
                @if($active === 'j'.$j->RunningNumber || $active === 'a'.$j->RunningNumber)
                    <div class="collapsible-header truncate waves-effect waves-orange nav-font-size  active" id="joblist{{$n}}"> 
                @else
                    <div class="collapsible-header truncate waves-effect waves-orange nav-font-size " id="joblist{{$n}}">
                @endif 
                        {{$j->JobTitle}}
                    </div>
                    <div class="collapsible-body">
                        <ul>
                        @if($active === 'j'.$j->RunningNumber)
                            <li class="active">
                        @else 
                            <li>
                        @endif
                                <a href="/company/{{$company->RunningNumber}}/job/{{$j->RunningNumber}}" class="waves-effect waves-orange grey-text text-darken-3 nav-font-size" id="JobDetail{{$n}}">
                                    ดูรายละเอียดงาน
                                </a>
                            </li>
                        @if($active === 'a'.$j->RunningNumber)
                            <li class="active inner">
                        @else 
                            <li class="inner">
                        @endif
                                <a href="/company/{{$company->RunningNumber}}/job/{{$j->RunningNumber}}/resumes" class="waves-effect waves-orange grey-text text-darken-3 nav-font-size" id="ApplyID{{$n}}">
                                    ดูผู้สมัคร/ผู้สนใจ/ผู้เข้าดูงาน
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{--*/$n++/*--}}
            @endforeach
            </ul>
        </ul>
        <header>
            <nav class="middle-nav light-blue darken-3">
                <div class="container">
                    <a href="#" data-activates="slide-out" class="icon button-collapse">
                        <i class="material-icons icon-menu">
                            menu
                        </i>
                    </a>
                    <div class="nav-wrapper">
                        <a class="page-title">
                            @yield('brand')
                        </a>
                    </div>
                </div>  
            </nav>
        </header>
        <main>
            @yield('content')
            <div class="fixed-action-btn horizontal click-to-toggle">
                <a class="btn-floating btn-large " id="scroll" >
                 <i class="material-icons">navigation</i>
                </a>
            </div>
        </main>
        <script src="{{ asset('/js/jquery-3.1.0.min.js')}}"></script>
        <script src="{{ asset('/materialize/js/materialize.min.js') }}"></script>
        @yield('scriptLink')
        <script src="{{ asset('/companyHR/js/layout.js') }}"></script>
        <script src="{{ asset('/companyHR/js/backToTop.js') }}"></script>

    </body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>ค้นหาบริษัทงาน</title>
        <link href="{{ asset('/materialize/css/Material+Icons.css') }}" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="{{ asset('/materialize/css/materialize.css') }}" media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="{{ asset('/MaterialDesignIcon/css/materialdesignicons.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/companyHR/css/landing.css') }}"/>
</head>
<body>
<div class="row">
    <div class="col s12 light-blue darken-3" style="height:30px; ">
        <div class="logout">
            <a href="/logout" id="logout" class="white-text">
                <i class="mdi mdi-logout mdi-24px "></i>
            </a>
        </div>
    </div>
    <div class="row grey lighten-4">
        <div class="row">
            <span class="col s12 m2 offset-m1 search-layout" style="font-size:28px;"> CompanyHR </span>
            <form id="form" role="form" class="col m9 s12">
                <div class="input-field col s8 m8">
                    <input id="name" type="search" placeholder="ค้นหา">
                    <i id = "close" class="material-icons">close</i>
                </div>
                <div class="col s4 m4 search-layout" >
                    <a id="search" class="waves-effect waves-light btn light-blue darken-3">ค้นหา</a>
                </div>
            </form>
        </div>
    </div>

    <div class = "container">
        <div><h5>ชื่อบริษัท</h5></div>
        <span id="total"></span>
        <hr>
        <div id="list" class="truncate"></div>
    </div>
    <ul id="pagination-demo" class="pagination-sm center-align write"></ul>
</div>
    

</body>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="{{ asset('/js/jquery-3.1.0.min.js')}}"></script>
    <script src="{{ asset('/materialize/js/materialize.min.js') }}"></script>
    <script src="{{ asset('/companyHR/js/landing.js') }}"></script>    
    <script src="{{ asset('/js/jquery.twbsPagination.min.js')}}"></script>  
</html>
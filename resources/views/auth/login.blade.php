<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="{{ asset('/materialize/css/Material+Icons.css') }}" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="{{ asset('/materialize/css/materialize.css') }}" media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="{{ asset('/companyHR/css/login.css') }}"/>
        <link rel="stylesheet" media="all" href="{{ asset('/font-awesome/css/font-awesome.min.css') }}">
    </head>
    <body class="parent">
        <div class="blur"></div>
        <div class="child">
            <h4 class="center-align white-text h4">CompanyHR Admin</h4>
            <div class="white-text">
                <form class="formValidate" id="formValidate" novalidate="novalidate" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="row ">
                        <div class="input-field col s12 ">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="email">อีเมล์</label>
                            <input id="email" type="email" name="email" data-error=".errorTxt1">
                            <div class="errorTxt1 height" >
                                @if ($errors->has('email'))
                                <div class="error">
                                    อีเมล์หรือรหัสผ่านของคุณไม่ถูกต้อง
                                </div>
                                @endif
                            </div>
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">vpn_key</i>
                            <label for="password">รหัสผ่าน</label>
                            <input id="password" type="password" name="password" data-error=".errorTxt2">
                            <div class="errorTxt2 height">
                            </div>  
                             
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col s6 center-align">
                            <button id="submit" type="submit" class="btn light-blue">
                                <i class="fa fa-btn fa-sign-in"></i> Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ asset('/js/jquery-3.1.0.min.js')}}"></script>
        <script src="{{ asset('/materialize/js/materialize.min.js') }}"></script>
        <script src="{{ asset('/jquery-validation/dist/jquery.validate.js')}}"></script>
        <script src="{{ asset('/jquery-validation/dist/additional-methods.js')}}"></script>
        <script src="{{ asset('/companyHR/js/login.js') }}"></script>
    </body>
</html>
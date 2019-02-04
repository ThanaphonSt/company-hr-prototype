@extends('companyHR.layout')
@section('title')
    {{$company->CompanyName}}
@endsection

@section('link')
	<link type="text/css" rel="stylesheet" href="{{ asset('/companyHR/css/dashboard.css')}}"/>
	<link rel="stylesheet" href="{{ asset('/companyHR/css/circle.css')}}">
@endsection
@section('brand')
<div class="brand-layout">
	Company HR
</div>
@endsection
@section('content')
<div class="row">
	<div class="col s12 m6 layout-top">
		<div class="row card z-depth-1 hoverable "> 
			<div class="col s12">
				<div class ="col s3 card-content">
					<i class="material-icons rcorners-icons-top z-depth-1">visibility</i>
				</div>
				<div class ="col s9 card-content">
					<span class="font-size-top">{{number_format($countView)}} </span>
					<span class="grey-text text-lighten-1">ผู้เข้าดูงาน</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col s12 m6 layout-top">
		<div class="row card z-depth-1 hoverable margin-card"> 
			<div class="col s12">
				<div class ="col s3 card-content">
					<i class="material-icons rcorners-icons-top z-depth-1">perm_identity</i>
				</div>
				<div class ="col s9 card-content">
					<span class="font-size-top">{{number_format($countApply)}} </span>
					<span class="grey-text text-lighten-1">ผู้สมัคร</span>			
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" id="job"></div>
<ul id="pagination-demo" class="pagination-sm center-align write"></ul>
<input type="hidden" id="companyID" value="/company/{{$company->RunningNumber}}/joblist"> 
@endsection
@section('scriptLink')
	<script src="{{ asset('/companyHR/js/dashboard.js')}}"></script> 
	<script src="{{ asset('/js/jquery.twbsPagination.min.js')}}"></script>
@endsection

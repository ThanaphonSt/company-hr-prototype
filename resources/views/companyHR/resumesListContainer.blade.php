@extends('companyHR.layout')
@section('title')
{{$job->JobTitle}}
@endsection
@section('link')
	<link type="text/css" rel="stylesheet" href="{{ asset('/companyHR/css/resumesList.css')}}"/>
    <link rel="stylesheet" media="all" href="{{ asset('/font-awesome/css/font-awesome.min.css') }}">
@endsection
@section('brand')
    <div class="brand-size truncate">
        {{$job->JobTitle}}
    </div>
@endsection
@section('content')
<div class="row">
    <div class="">
        <ul class="nav nav-tabs tabs indicator z-depth-1">
            <li class="active tab col s4 hoverable" data-type="apply">
                <a data-toggle="tab" href="#apply" class="font-color-tabs" data-type="apply" id="tabApply">
                    ผู้สมัคร
                    <span class="hide-on-small-only ">({{$job->applyCount}})
                    </span>
                </a>
            </li>
            <li class="tab col s4 hoverable" data-type="favorite">
                <a data-toggle="tab" href="#favorite" class="font-color-tabs" data-type="favorite" id="tabFavorite">
                    ผู้สนใจ 
                    <span class="hide-on-small-only ">({{$job->favoriteCount}})
                    </span>
                </a>
            </li>
            <li class="tab col s4 hoverable" data-type="view">
                <a data-toggle="tab" href="#view" class="font-color-tabs" data-type="view" id="tabView">
                    ผู้เข้าดูงาน 
                    <span class="hide-on-small-only ">({{$job->viewCount}})
                    </span>
                </a>
            </li>
        </ul>
        <div class="tab-content col s12">
            <div id="apply" class="tab-pane fade in ">
            
            </div>
        </div>
        <div class="tab-content col s12">
            <div id="favorite" class="tab-pane fade in ">

            </div>
        </div>
        <div class="tab-content col s12">
            <div id="view" class="tab-pane fade in ">
            </div>
        </div>
    </div>
</div>
<div class="row" id="resumesList"></div>
<ul id="pagination-demo-apply" class="pagination-sm center-align write"></ul>
<ul id="pagination-demo-favorite" class="pagination-sm center-align write"></ul>
<ul id="pagination-demo-view" class="pagination-sm center-align write"></ul>
<input type="hidden" id="resumesListID" value="/company/{{$company->RunningNumber}}/job/{{$job->RunningNumber}}/">
@endsection
@section('scriptLink')
	<script src="{{  asset('js/jquery.twbsPagination.min.js') }}"></script>
	<script src="{{  asset('/companyHR/js/resumesList.js') }}"></script>
@endsection

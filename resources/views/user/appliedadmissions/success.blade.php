@extends('layouts/contentLayoutMaster')

@section('title', 'Application #'.$application->id)

@section('vendor-style')
<link rel="stylesheet" href="{{asset(mix('vendors/css/charts/apexcharts.css'))}}">
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset(mix('css/base/pages/app-chat-list.css'))}}">
@endsection

@section('content')
<!-- Card Advance -->
<div class="row match-height">
  <!-- Congratulations Card -->
  

  <!-- Developer Meetup Card -->
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card card-developer-meetup">
      <div class="meetup-img-wrapper rounded-top text-center">
        <img src="{{asset('images/illustration/email.svg')}}" alt="Meeting Pic" height="170" />
      </div>
      <div class="card-body">
        <div class="meetup-header d-flex align-items-center">
          <div class="meetup-day">
            <h6 class="mb-0">{{substr($application->created_at->format('M'), 0, 3)}}</h6>
            <h3 class="mb-0">{{$application->created_at->format('d')}}</h3>
          </div>
          <div class="my-auto">
            <h4 class="card-title mb-25">{{$application->universityAddmission->program->user->name}}</h4>
            <p class="card-text mb-0">{{$application->universityAddmission->program->name}}</p>
          </div>
        </div>
        <div class="media">
          <div class="avatar bg-light-primary rounded mr-1">
            <div class="avatar-content">
              <i data-feather="calendar" class="avatar-icon font-medium-3"></i>
            </div>
          </div>
          <div class="media-body">
            <h6 class="mb-0">{{$application->created_at->format('D, M d, Y')}}</h6>
            <small>{{$application->created_at->format('H:m')}}</small>
          </div>
        </div>
        <br>
        <!-- <button type="button" class="btn btn-primary btn-block waves-effect waves-float waves-light"></button> -->
        
      </div>
    </div>
  </div>
  <!--/ Developer Meetup Card -->


</div>


<!--/ Card Advance -->
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/charts/apexcharts.min.js'))}}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/cards/card-advance.js')) }}"></script>
@endsection

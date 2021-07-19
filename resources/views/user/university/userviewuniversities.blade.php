@extends('layouts/contentLayoutMaster')

@section('title', 'Universities')

@section('vendor-style')
<link rel="stylesheet" href="{{asset(mix('vendors/css/charts/apexcharts.css'))}}">
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset(mix('css/base/pages/app-chat-list.css'))}}">
@endsection

@section('content')



<div class="row match-height">


@foreach($universityInformations as $universityInformation)
  <!-- Profile Card -->
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card card-profile">
      <img
        src="{{asset('university/cover/'.$universityInformation->cover)}}"
        class="img-fluid card-img-top"
        alt="Profile Cover Photo"
      />
      <div class="card-body">
        <div class="profile-image-wrapper">
          <div class="profile-image">
            <div class="avatar">
              <img src="{{asset('university/logo/'.$universityInformation->logo)}}" alt="Profile Picture" />
            </div>
          </div>
        </div>
        <h3>{{$universityInformation->user->name}}</h3>
        <h6 class="text-muted">{{$universityInformation->address}}</h6>
        <a href="/user/view/universityprofile/{{$universityInformation->user->id}}"><div class="badge badge-light-primary profile-badge">View</div></a>
        <hr class="mb-2" />
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="text-muted font-weight-bolder">Active</h6>
            <h3 class="mb-0">{{count($universityInformation->user->universityAddmission)}}</h3>
          </div>
          <div>
            <h6 class="text-muted font-weight-bolder">Departments</h6>
            <h3 class="mb-0">{{count($universityInformation->user->department)}}</h3>
          </div>
          <div>
            <h6 class="text-muted font-weight-bolder">Programs</h6>
            <h3 class="mb-0">{{count($universityInformation->user->program  )}}</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Profile Card -->

@endforeach
</div>


@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/charts/apexcharts.min.js'))}}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/cards/card-advance.js')) }}"></script>
@endsection

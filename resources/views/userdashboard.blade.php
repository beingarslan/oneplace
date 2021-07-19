@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">
@endsection

@section('content')
<div id="user-profile">


  <!-- profile info section -->
  <section id="profile-info">
    <div class="row">
      <!-- left profile info section -->
      <div class="col-lg-3 col-12 order-2 order-lg-1">
        <!-- about -->

        @if(Auth::user()->profile == "Incomplete")
        <div class="card bg-danger text-white">
          <div class="card-body">
            <h4 class="card-title text-white">Profile Incompleted</h4>
            <p class="card-text">You are not eligible to apply for the admissions. <a class="card-link" style="color: blue;" href="/user/details/edit/">Complete your profile</a></p>

          </div>
        </div>
        @else
        <div class="card bg-success text-white">
          <div class="card-body">
            <h4 class="card-title text-white">Profile Completed</h4>
            <p class="card-text">You are eligible to apply for the admissions.</p>
          </div>
        </div>
        @endif
        <!--/ about -->

        <!-- suggestion pages -->
        <div class="card">
          <div class="card-body profile-suggestion">
            <h5 class="mb-2">Programs</h5>
            <!-- Program -->
            @foreach($programs as $program)
            <div class="d-flex justify-content-start align-items-center mb-1">
              <div class="profile-user-info">
                <a href="/user/university/view/program/{{$program->id}}"> <h6 class="mb-0">{{$program->name}}</h6></a>
                <small class="text-muted">{{$program->department->name}}</small>
              </div>
              <div class="profile-star ml-auto"><i data-feather="star" class="font-medium-3"></i></div>
            </div>
            <!-- Program -->
            @endforeach

          </div>
        </div>
        <!--/ suggestion pages -->

        <!-- twitter feed card -->
        <div class="card">
          <div class="card-body">
            <h5>Announcement Feeds</h5>
            @foreach($universityAnnouncements as $universityAnnouncement)
            <!-- twitter feed -->
            <div class="profile-twitter-feed mt-1">
              <div class="d-flex justify-content-start align-items-center mb-1">
                <div class="avatar mr-1">
                  <img src="{{asset('university/logo/'.$universityAnnouncement->user->universityInformation->logo)}}" alt="avatar img" height="40" width="40" />
                </div>
                <div class="profile-user-info">
                  <h6 class="mb-0">{{$universityAnnouncement->title}}</h6>
                  <a href="javascript:void(0)">
                    <small class="text-muted">{{'@'.$universityAnnouncement->user->universityInformation->username}}</small>
                    <i data-feather="check-circle"></i>
                  </a>
                </div>
                <!-- <div class="profile-star ml-auto">
                  <i data-feather="star" class="font-medium-3"></i>
                </div> -->
              </div>
              <p class="card-text mb-50">{{$universityAnnouncement->description}}</p>
              <!-- <a href="javascript:void(0)">
                <small>#design #fasion</small>
              </a> -->
            </div>
            <!-- twitter feed -->
            @endforeach

          </div>
        </div>
        <!--/ twitter feed card -->
      </div>
      <!--/ left profile info section -->

      <div class="col-lg-6 col-12 order-1 order-lg-2">
        @foreach($univeristyAddmissions as $univeristyAddmission)
        <!-- post 1 -->
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-start align-items-center mb-1">
              <!-- avatar -->
              <div class="avatar mr-1">
                <img src="{{asset('university/logo/'.$univeristyAddmission->user->universityInformation->logo)}}" alt="avatar img" height="50" width="50" />
              </div>
              <!--/ avatar -->
              <div class="profile-user-info">
                <h6 class="mb-0">{{Auth::user()->name}}</h6>
                <small class="text-muted">{{$univeristyAddmission->created_at->diffForHumans() }}</small>
              </div>

            </div>
            <p class="card-text">
              {{$univeristyAddmission->description}}
            </p>
            <!-- post img -->
            <img class="img-fluid rounded mb-75" src="{{asset('university/admissions/'.$univeristyAddmission->cover)}}" alt="avatar img" />
            <!--/ post img -->
            <!-- like share -->
            <div class="row d-flex justify-content-start align-items-center flex-wrap pb-50">
              <div class="col-sm-6 d-flex justify-content-between justify-content-sm-start mb-2">
                <a href="/user/university/view/program/{{$univeristyAddmission->programid}}" class="d-flex align-items-center">

                  <span> {{$univeristyAddmission->program->name}}</span>
                </a>


              </div>

              <!-- share and like count and icons -->
              <div class="col-sm-6 d-flex justify-content-between justify-content-sm-end align-items-center mb-2">
                <a href="javascript:void(0)" class="text-nowrap">
                  <span class=" mr-1">Last Date: {{$univeristyAddmission->created_at->format("m/d/Y") }}</span>
                </a>
                
                
              </div>
              
              <!-- share and like count and icons -->
            </div>
            <!-- like share -->
            <form action="{{route('user-appliedAdmission')}}" method="post">
              @csrf 
              <input type="hidden" name="univeristy_addmissionid" value="{{$univeristyAddmission->id}}" >
              <button type="submit" class="btn btn-primary btn-block waves-effect waves-float waves-light">Apply</button>
            </form>
          </div>
        </div>
        <!--/ post 1 -->
        @endforeach
      </div>
      <!--/ center profile info section -->

      <!-- right profile info section -->
      <div class="col-lg-3 col-12 order-3">
        <!-- Departments -->
        <div class="card">
          <div class="card-body">
            <h5 class="mb-2">Departments</h5>
            @foreach($deprtments as $deprtment)
            @if(count($deprtment->program)>0)
            <div class="d-flex justify-content-start align-items-center mt-2">
              <div class="avatar mr-75">
                <img src="{{asset('university/departments/'.$deprtment->cover)}}" alt="avatar" height="40" width="40" />
              </div>
              <div class="profile-user-info">
                <h6 class="mb-0">{{$deprtment->name}}</h6>
                <small class="text-muted">{{count($deprtment->program)}} Active Programs</small>
              </div>
              <a href="/user/university/view/{{$deprtment->id}}/programs" class="btn btn-primary btn-icon btn-sm ml-auto">
                <i data-feather="eye"></i>
              </a>
            </div>
            @endif
            @endforeach

          </div>
        </div>
        <!--/ Departments -->
      </div>
      <!--/ right profile info section -->
    </div>

    <!-- reload button -->
    <div class="row">
      <div class="col-12 text-center">
        <button type="button" class="btn btn-sm btn-primary block-element border-0 mb-1">Load More</button>
      </div>
    </div>
    <!--/ reload button -->
  </section>
  <!--/ profile info section -->
</div>
@endsection

@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/page-profile.js')) }}"></script>
@endsection
@extends('layouts/contentLayoutMaster')

@section('title', $universityInformation->name)

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">
@endsection

@section('content')
<div id="user-profile">
  <!-- profile header -->
  @include('university/profile/profileheader')

  <!--/ profile header -->

  <div class="row match-height">

    @foreach($programs as $program)
    <!-- App Design Card -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card card-app-design">
        <div class="card-body">
            <div class="badge badge-light-{{$program->status == '1' ? 'success' : 'danger' }}">{{$program->status == '1' ? 'Active' : 'Not Active' }}</div>
            <h4 class="card-title mt-1 mb-75">{{$program->name}}</h4>
            <p class="card-text font-small-2 mb-2">
            {{$program->description}}
            </p>
            <hr class="mb-2">
            
            <div class="design-planning-wrapper">
                <div class="design-planning">
                    <p class="card-text mb-25">Show Ups</p>
                    <h6 class="mb-0">45k</h6>
                </div>
                <div class="design-planning">
                    <p class="card-text mb-25">Clicks</p>
                    <h6 class="mb-0">2.6k</h6>
                </div>
                <div class="design-planning">
                    <p class="card-text mb-25">Engages</p>
                    <h6 class="mb-0">1.5k</h6>
                </div>
            </div>

            <a href="/university/view/program/{{$program->id}}" class="btn btn-primary btn-block">View</a>
        </div>
        </div>
    </div>
    <!--/ App Design Card -->
    @endforeach

</div>

</div>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/page-profile.js')) }}"></script>
@endsection

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

  <!-- profile info section -->
  <section id="profile-info">
    <div class="row">
      <!-- left profile info section -->
      <div class="col-lg-3 col-12 order-2 order-lg-1">
        <!-- about -->
        <div class="card">
          <div class="card-body">
            <h5 class="mb-75">About</h5>
            <p class="card-text">
              {{$universityInformation->about}}
            </p>
            <div class="mt-2">
              <h5 class="mb-75">Since:</h5>
              <p class="card-text">{{\Carbon\Carbon::parse($universityInformation->date_of_established)->format('d M, Y')}}</p>
            </div>
            <div class="mt-2">
              <h5 class="mb-75">Phone:</h5>
              <p class="card-text">{{$universityInformation->primary_phone}}</p>
            </div>
            <div class="mt-2">
              <h5 class="mb-75">Email:</h5>
              <p class="card-text">{{$universityInformation->email}}</p>
            </div>
            <div class="mt-2">
              <h5 class="mb-50">Website:</h5>
              <p class="card-text mb-0">{{$universityInformation->website}}</p>
            </div>
            <div class="mt-2">
              <h5 class="mb-50">Address:</h5>
              <p class="card-text mb-0">{{$universityInformation->address}}</p>
            </div>
            <div class="mt-2">
              <h5 class="mb-50">Socials:</h5>
              @foreach($universitySocials as $universitySocial)
                <a style="font-size: 30px;" href="{{$universitySocial->url}}" target="_blank" rel="noopener noreferrer">
                    <?php echo App\Social::where('id', $universitySocial->socialid)->pluck('icon')->first(); ?>
                </a>
              @endforeach
            </div>
          </div>
        </div>
        <!--/ about -->

        <!-- suggestion pages -->
        <div class="card">
          <div class="card-body profile-suggestion">
            <h5 class="mb-2"><a href="/user/university/view/programs/{{$universityInformation->user->id}}"> Programs </a></h5>
            <!-- Program -->
            @foreach($programs as $program)
            <div class="d-flex justify-content-start align-items-center mb-1">
              <div class="profile-user-info">
                <h6 class="mb-0">{{$program->name}}</h6>
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
            <h5><a href="/user/university/manage/announcements">Announcement Feeds</a></h5>
            @foreach($universityAnnouncements as $universityAnnouncement)
            <!-- twitter feed -->
            <div class="profile-twitter-feed mt-1">
              <div class="d-flex justify-content-start align-items-center mb-1">
                <div class="avatar mr-1">
                <img src="{{asset('university/logo/'.$universityInformation->logo)}}" alt="avatar img" height="40" width="40" />
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

      <!-- center profile info section -->
      <div class="col-lg-6 col-12 order-1 order-lg-2">
      @foreach($univeristyAddmissions as $univeristyAddmission)
        <!-- post 1 -->
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-start align-items-center mb-1">
              <!-- avatar -->
              <div class="avatar mr-1">
                <img
                  src="{{asset('university/logo/'.$universityInformation->logo)}}"
                  alt="avatar img"
                  height="50"
                  width="50"
                />
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
            <img
              class="img-fluid rounded mb-75"
              src="{{asset('university/admissions/'.$univeristyAddmission->cover)}}"
              alt="avatar img"
            />
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

                <!-- <a href="javascript:void(0)" class="text-nowrap">
                  <i data-feather="share-2" class="text-body font-medium-3 mx-50"></i>
                  <span class="text-muted">1.25k</span>
                </a> -->
              </div>
              <!-- share and like count and icons -->
            </div>
            <!-- like share -->
            
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
            <h5 class="mb-2"><a href="/user/university/view/departments/{{$universityInformation->user->id}}"> Departments </a></h5>
            @foreach($deprtments as $deprtment)
            <div class="d-flex justify-content-start align-items-center mt-2">
              <div class="avatar mr-75">
                <img
                  src="{{asset('university/departments/'.$deprtment->cover)}}"
                  alt="avatar"
                  height="40"
                  width="40"
                />
              </div>
              <div class="profile-user-info">
                <h6 class="mb-0">{{$deprtment->name}}</h6>
                <small class="text-muted">{{count($deprtment->program)}} Active Programs</small>
              </div>
              <a href="/user/university/view/{{$deprtment->id}}/programs" class="btn btn-primary btn-icon btn-sm ml-auto">
                <i data-feather="eye"></i>
              </a>
            </div>
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

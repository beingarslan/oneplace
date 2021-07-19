@extends('layouts/contentLayoutMaster')

@section('title', 'University Announcements')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">
@endsection

@section('content')
<div id="user-profile">
  


<!-- Style variation -->
<section id="card-style-variation">
  <h5 class="mt-3 mb-2">Add New Announcement</h5>
 

  <!-- Outline -->
  <div class="row">

    <div class="col-md-12 col-xl-12">
      <div class="card shadow-none bg-transparent border-danger">
        <div class="card-body">
        <form method="post"  class="form form-horizontal" action="{{route('university-saveannouncements')}}">
          @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                    <input type="text" id="first-name" maxlength="13" class="form-control" name="title" placeholder="Title" />
                
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                    <textarea
                        class="form-control"
                        id="exampleFormControlTextarea1"
                        rows="3"
                        name="description"
                        placeholder="Announcement"
                    ></textarea>   
                </div>
              </div>
            </div>
            <div class="card-foter">
                <button type="submit" class="btn btn-primary mr-1">Add</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>

  </div>
</section>
<!--/ Style variation -->

  <!-- profile info section -->
  <section id="profile-info">
    <div class="row">
      <!-- left profile info section -->
      <div class="col-lg-12 col-12 order-2 order-lg-1">
        <!-- twitter feed card -->
        @if(count($universityAnnouncements)>0)
        <div class="card">
          <div class="card-body">
            <h5>Announcement Feeds</h5>
            @foreach($universityAnnouncements as $universityAnnouncement)
            <!-- twitter feed -->
            <div class="profile-twitter-feed mt-1">
              <div class="d-flex justify-content-start align-items-center mb-1">
                <div class="avatar mr-1">
                  <img src="{{asset('university/logo/'.App\UniversityInformation::where('userid', Auth::user()->id)->pluck('logo')->first())}}" alt="avatar img" height="40" width="40" />
                </div>
                <div class="profile-user-info">
                  <h6 class="mb-0">{{$universityAnnouncement->title}}</h6>
                  <a href="javascript:void(0)">
                    <small class="text-muted"> {{'@'.Auth::user()->universityInformation->username}}</small>
                    <!-- <i data-feather="check-circle"></i> -->
                  </a>
                </div>
                <div class="profile-star ml-auto">
                  <a href="javascript:void(0)" data-toggle="modal" data-target="#primary{{$universityAnnouncement->id}}"><i data-feather="edit" class="font-medium-3"></i></a>
                  
                </div>
              </div>
              <p class="card-text mb-50">{{$universityAnnouncement->description}}</p>
              <!-- <a href="javascript:void(0)">
                <small>#design #fasion</small>
              </a> --> 
            </div>
            <!-- twitter feed -->
            <!-- Modal -->
            <div
                  class="modal fade text-left modal-primary"
                  id="primary{{$universityAnnouncement->id}}"
                  tabindex="-1"
                  role="dialog"
                  aria-labelledby="myModalLabel160"
                  aria-hidden="true"
                >
                    <form action="{{ route('university-updateannouncements') }}" method="post"  enctype="multipart/form-data"> 
                        @csrf 
                        <input type="hidden" name="id" value="{{$universityAnnouncement->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel160">Announcement ID #{{$universityAnnouncement->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                        <label for="first-name-vertical">Title</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="title" value="{{$universityAnnouncement->title}}" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                        <label for="contact-info-vertical">Description</label>
                                        <input type="text" id="contact-info-vertical" class="form-control" name="description" value="{{$universityAnnouncement->description}}" placeholder="Description">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                    <div class="demo-inline-spacing">
            
                                    <div class="custom-control custom-control-success custom-radio">
                                    <input
                                        type="radio"
                                        id="customColorRadio3{{$universityAnnouncement->id}}"
                                        name="status"
                                        class="custom-control-input"
                                        value="1"
                                        {{$universityAnnouncement->status=='1'? 'checked':'' }}
                                    />
                                    <label class="custom-control-label" for="customColorRadio3{{$universityAnnouncement->id}}">Active</label>
                                    </div>
                                    <div class="custom-control custom-control-danger custom-radio">
                                    <input
                                        type="radio"
                                        id="customColorRadio5{{$universityAnnouncement->id}}"
                                        name="status"
                                        class="custom-control-input"
                                        value="0"
                                        
                                        {{$universityAnnouncement->status=='0'? 'checked':'' }}
                                    />
                                    <label class="custom-control-label" for="customColorRadio5{{$universityAnnouncement->id}}">In-Active</label>
                                    </div>
                                    </div>
                                    </div>
                                    
                                </div>
                                
                                    
                                
                            </div>
                            <div class="modal-footer">
                            
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                            </div>
                        </div>
                        </div>
                  
                    </form>
            
        
                </div>


            <!-- Model End -->
            @endforeach
          </div>
          {{ $universityAnnouncements->links() }}
        </div>
        @endif
        <!--/ twitter feed card -->

      </div>
      <!--/ left profile info section -->

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

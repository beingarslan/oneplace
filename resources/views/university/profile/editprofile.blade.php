@extends('layouts/contentLayoutMaster')

@section('title', Auth::user()->name.' Profile Settings')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- account setting page -->
<section id="page-account-settings">
  <div class="row">
    <!-- left menu section -->
    <div class="col-md-3 mb-2 mb-md-0">
      <ul class="nav nav-pills flex-column nav-left">
        <!-- general -->
        <li class="nav-item">
          <a
            class="nav-link active"
            id="account-pill-general"
            data-toggle="pill"
            href="#account-vertical-general"
            aria-expanded="true"
          >
            <i data-feather="user" class="font-medium-3 mr-1"></i>
            <span class="font-weight-bold">General</span>
          </a>
        </li>
        <!-- change password -->
        <li class="nav-item">
          <a
            class="nav-link"
            id="account-pill-password"
            data-toggle="pill"
            href="#account-vertical-password"
            aria-expanded="false"
          >
            <i data-feather="lock" class="font-medium-3 mr-1"></i>
            <span class="font-weight-bold">Change Password</span>
          </a>
        </li>
        <!-- information -->
        <li class="nav-item">
          <a
            class="nav-link"
            id="account-pill-info"
            data-toggle="pill"
            href="#account-vertical-info"
            aria-expanded="false"
          >
            <i data-feather="info" class="font-medium-3 mr-1"></i>
            <span class="font-weight-bold">Information</span>
          </a>
        </li>
        <!-- social -->
        <li class="nav-item">
          <a
            class="nav-link"
            id="account-pill-social"
            data-toggle="pill"
            href="#account-vertical-social"
            aria-expanded="false"
          >
            <i data-feather="link" class="font-medium-3 mr-1"></i>
            <span class="font-weight-bold">Social</span>
          </a>
        </li>
        
      </ul>
    </div>
    <!--/ left menu section -->

    <!-- right content section -->
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">
          <div class="tab-content">
            <!-- general tab -->
            <div
              role="tabpanel"
              class="tab-pane active"
              id="account-vertical-general"
              aria-labelledby="account-pill-general"
              aria-expanded="true"
            >
              <!-- header media -->
              <div class="media">
                <a href="javascript:void(0);" class="mr-25">
                  <img
                    src="{{asset('university/logo/'.$universityInformation->logo)}}"
                    id="account-upload-img"
                    class="rounded mr-50"
                    alt="profile image"
                    height="80"
                    width="80"
                  />
                </a>
                <form action="{{ route('uploadlogo') }}" id="account-upload-form" method="post" enctype="multipart/form-data">
                @csrf 
                <input type="hidden" name="id" value="{{$universityInformation->id}}">
                <!-- upload and reset button -->
                <div class="media-body mt-75 ml-1">
                  <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                  <input type="file" id="account-upload" name="logo" onchange="uploadlogo()" hidden accept="image/*" />
                  
                  <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                </div>
                <!--/ upload and reset button -->
                </form>
              </div>
              <!--/ header media -->

              <!-- form -->
              <form class="mt-2" action="{{ route('university-updateprofile') }}" method="post">
              @csrf
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="form-group">
                      <label for="account-username">Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-username"
                        name="name"
                        placeholder="Name"
                        value="{{$universityInformation->name}}"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-username">Username</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-username"
                        name="username"
                        placeholder="Username"
                        value="{{$universityInformation->username}}"
                      />
                    </div>
                  </div>
                  
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-username">Email</label>
                      <input
                        type="email"
                        class="form-control"
                        id="account-username"
                        name="email"
                        placeholder="Email"
                        value="{{$universityInformation->email}}"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-username">Primary Phone</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-username"
                        name="primary_phone"
                        placeholder="Primary Phone"
                        value="{{$universityInformation->primary_phone}}"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-username">Website</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-username"
                        name="website"
                        placeholder="Website"
                        value="{{$universityInformation->website}}"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-username">Date Of Established</label>
                      <input
                        type="date"
                        class="form-control"
                        id="account-username"
                        name="date_of_established"
                        placeholder="Date Of Established"
                        value="{{$universityInformation->date_of_established}}"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-username">ID</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-username"
                        name="id"
                        readonly
                        placeholder="Username"
                        value="{{$universityInformation->id }}"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-sm-12">
                    <div class="form-group">
                      <label for="account-username">Address</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-username"
                        name="address"
                        placeholder="Address"
                        value="{{$universityInformation->address}}"
                      />
                    </div>
                  </div>

                  
                  
                  
                  
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                  </div>
                </div>
              </form>
              <!--/ form -->
            </div>
            <!--/ general tab -->

            <!-- change password -->
            <div
              class="tab-pane fade"
              id="account-vertical-password"
              role="tabpanel"
              aria-labelledby="account-pill-password"
              aria-expanded="false"
            >
              <!-- form -->
              <form class=""  action="{{ route('university-updatepassword') }}" method="post">
              @csrf
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-old-password">Old Password</label>
                      <div class="input-group form-password-toggle input-group-merge">
                        <input
                          type="password"
                          class="form-control"
                          id="account-old-password"
                          name="current_password"
                          placeholder="Old Password"
                        />
                        <div class="input-group-append">
                          <div class="input-group-text cursor-pointer">
                            <i data-feather="eye"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-new-password">New Password</label>
                      <div class="input-group form-password-toggle input-group-merge">
                        <input
                          type="password"
                          id="account-new-password"
                          name="new_password"
                          class="form-control"
                          placeholder="New Password"
                        />
                        <div class="input-group-append">
                          <div class="input-group-text cursor-pointer">
                            <i data-feather="eye"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-retype-new-password">Retype New Password</label>
                      <div class="input-group form-password-toggle input-group-merge">
                        <input
                          type="password"
                          class="form-control"
                          id="account-retype-new-password"
                          name="new_confirm_password"
                          placeholder="New Password"
                        />
                        <div class="input-group-append">
                          <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                  </div>
                </div>
              </form>
              <!--/ form -->
            </div>
            <!--/ change password -->

            <!-- information -->
            <div
              class="tab-pane fade"
              id="account-vertical-info"
              role="tabpanel"
              aria-labelledby="account-pill-info"
              aria-expanded="false"
            >
              <!-- form -->
              <form class="" action="{{route('university-updateabout')}}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$universityInformation->id}}">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="accountTextarea">Bio</label>
                      <textarea
                        class="form-control"
                        id="accountTextarea"
                        rows="4"
                        name="about"
                        placeholder="Your Bio data here..."
                      >{{$universityInformation->about}}</textarea>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-1 mr-1">Save changes</button>
                    
                  </div>
                </div>
              </form>
              <!--/ form -->
            </div>
            <!--/ information -->

            <!-- social -->
            <div
              class="tab-pane fade"
              id="account-vertical-social"
              role="tabpanel"
              aria-labelledby="account-pill-social"
              aria-expanded="false"
            >
              <!-- form -->
              <form class="" action="{{route('university-saveuniversitysocials')}}" method="post">
              @csrf
                <div class="row">
                  <!-- social header -->
                  <div class="col-12">
                    <div class="d-flex align-items-center mb-2">
                      <i data-feather="link" class="font-medium-3"></i>
                      <h4 class="mb-0 ml-75">Social Links</h4>
                    </div>
                  </div>
                  <!-- twitter link input -->
                  @foreach($socials as $social)
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-{{$social->id}}">{{$social->name}}</label>
                      <input
                        type="text"
                        id="account-{{$social->id}}"
                        class="form-control"
                        placeholder="{{$social->name}}"
                        name="social{{$social->id}}"
                        value="{{App\UniversitySocial::where('userid', Auth::user()->id)->where('socialid', $social->id)->pluck('url')->first()}}"
                      />
                    </div>
                  </div>
                  @endforeach
                  

                  
                  <div class="col-12">
                    <!-- submit and cancel button -->
                    <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                  </div>
                </div>
              </form>
              <!--/ form -->
            </div>
            <!--/ social -->

            <!-- notifications -->
            <!-- <div
              class="tab-pane fade"
              id="account-vertical-notifications"
              role="tabpanel"
              aria-labelledby="account-pill-notifications"
              aria-expanded="false"
            >
              <div class="row">
                <h6 class="section-label mx-1 mb-2">Activity</h6>
                <div class="col-12 mb-2">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch1" />
                    <label class="custom-control-label" for="accountSwitch1">
                      Email me when someone comments onmy article
                    </label>
                  </div>
                </div>
                <div class="col-12 mb-2">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch2" />
                    <label class="custom-control-label" for="accountSwitch2">
                      Email me when someone answers on my form
                    </label>
                  </div>
                </div>
                <div class="col-12 mb-2">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="accountSwitch3" />
                    <label class="custom-control-label" for="accountSwitch3">Email me hen someone follows me</label>
                  </div>
                </div>
                <h6 class="section-label mx-1 mt-2">Application</h6>
                <div class="col-12 mt-1 mb-2">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch4" />
                    <label class="custom-control-label" for="accountSwitch4">News and announcements</label>
                  </div>
                </div>
                <div class="col-12 mb-2">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch6" />
                    <label class="custom-control-label" for="accountSwitch6">Weekly product updates</label>
                  </div>
                </div>
                <div class="col-12 mb-75">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="accountSwitch5" />
                    <label class="custom-control-label" for="accountSwitch5">Weekly blog digest</label>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                  <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                </div>
              </div>
            </div> -->
            <!--/ notifications -->
          </div>
        </div>
      </div>
    </div>
    <!--/ right content section -->
  </div>
</section>
<!-- / account setting page -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  {{-- select2 min js --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  {{--  jQuery Validation JS --}}
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/page-account-settings.js')) }}"></script>


  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  </script>

  <script>
    function uploadlogo(){
      $('#account-upload-form').submit();
      // var file_data = $('#account-upload').prop('files')[0];   
      // // var form_data = new FormData();    
      
      // // console.log(form_data);                     
      // // form_data.set('username', 'Chris');
      //  console.log(file_data);
      // $.ajax({ 
      //     type:'PUT',
      //     url:"{{ route('uploadlogo') }}",
      //     contentType: false,
      //     cache: false,
      //     processData:false,
      //     data:{
      //       id: id,
      //       logo: file_data
      //     },
      //     success:function(data){
      //           //updateDeliveryInterval(data);
      //           // var location = data.location;
      //           // $('#pickup_address').val(location.address);
      //           // $('#pickup_unit').val(location.unit);
      //           // $('#pickup_phone').val(location.phone);
      //           // $('#pickup_sender').val(location.phone);

      //     if(data=='done')
      //     {
      //       alert('done');
      //       document.location = "/";
      //     }
      //     else{
      //       return false;
      //     }
      //   }
      // });
    }
  </script>

@endsection

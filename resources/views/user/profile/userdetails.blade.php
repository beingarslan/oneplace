@extends('layouts/contentLayoutMaster')

@section('title', 'Student Information')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
@endsection

@section('content')
<!-- Horizontal Wizard -->


<section id="basic-horizontal-layouts">

  <div class="row">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <!-- header media -->
          <div class="media">
            <a href="javascript:void(0);" class="mr-25">
              <img src="{{asset('user/logo/'.$userDetail->image)}}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
            </a>

            <form action="{{ route('user-uploadlogo') }}" id="account-upload-form" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="userid" value="{{Auth::user()->id}}">
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
        </div>
        <div class="card-body">
        <form action="{{route('user-updateprofile')}}" method="post">
        @csrf            
        <div class="row">
              <div class="form-group col-md-6">
                <label class="form-label" for="username">Full Name</label>
                <input type="text" name="full_name" id="username" value="{{$userDetail->full_name}}" class="form-control" placeholder="Full Name" />
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="email">Date Of Birth</label>
                <input type="date" name="dob" id="email" value="{{$userDetail->dob}}" class="form-control" placeholder="Date Of Birth" aria-label="john.doe" />
              </div>
            </div>
            <div class="row">
              <div class="form-group form-password-toggle col-md-6">
                <label class="form-label" for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{$userDetail->phone}}" class="form-control" placeholder="Phone Number" />
              </div>
              <div class="form-group form-password-toggle col-md-6">
                <label class="form-label" for="confirm-password">City</label>
                <select name="city" class="select2 form-control form-control-lg">
                    <option  value="{{$userDetail->city}}">{{$userDetail->city}}</option>
                  <option value="AK">Alaska</option>
                  <option value="HI">Hawaii</option>
                  <option value="CA">California</option>
                </select>
              </div>
              <div class="form-group form-password-toggle col-md-6">
                <label class="form-label" for="confirm-password">Address</label>
                <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3" placeholder="Address">{{$userDetail->address}}</textarea>
              </div>
              <div class="form-group form-password-toggle col-md-6">
                <label class="form-label" for="confirm-password">Gender</label>

                <div class="demo-inline-spacing">
                  <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio1" value="Male" name="gender" class="custom-control-input" checked />
                    <label class="custom-control-label" for="customRadio1">Male</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio2" value="Female" name="gender" class="custom-control-input" />
                    <label class="custom-control-label" for="customRadio2">Female</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="content-header">
              <h5 class="mb-0">SSC/O-Level</h5>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Degree/Certification</label>
                <select name="ssc_degree" class="select2 form-control form-control-lg">
                  <option value="SSC">SSC</option>
                  <option value="O-Level">O-Level</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Board</label>
                <select name="ssc_board" class="select2 form-control form-control-lg">
                  <option value="Lahore">Lahore</option>
                  <option value="Faisalabad">Faisalabad</option>
                  <option value="Sahiwal">Sahiwal</option>
                  <option value="Multan">Multan</option>
                  <option value="Sarghoda">Sarghoda</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Institue</label>
                <input type="text" name="ssc_institue" value="{{$userDetail->ssc_institue}}" id="first-name" class="form-control" placeholder="Institue" />
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Passing Year</label>
                <select name="ssc_passing_year" class="select2 form-control form-control-lg">
                  @for($i = 2021;$i >= 1990; $i-- )
                  <option value="{{$i}}">{{$i}}</option>
                  @endfor
                </select>
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Roll Number</label>
                <input type="number" value="{{$userDetail->ssc_roll_number}}" name="ssc_roll_number" id="first-name" class="form-control" />
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Obt. Marks</label>
                <input type="number" value="{{$userDetail->ssc_obt_marks}}" name="ssc_obt_marks" id="first-name" class="form-control" />
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Total Marks</label>
                <input type="number"  value="{{$userDetail->ssc_total_marks}}"name="ssc_total_marks" id="first-name" class="form-control" />
              </div>
              <div class="form-group col-md-6">
                <div class="form-group">
                  <label for="customFile">Add Degree</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="ssc_document" id="customFile" />
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
              </div>
            </div>
            <!--  -->
            <hr class="mb-2">
            <div class="content-header">
              <h5 class="mb-0">HSSC/A-Level</h5>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Degree/Certification</label>
                <select name="hssc_degree" class="select2 form-control form-control-lg">
                  <option value="HSSC-1">HSSC-1</option>
                  <option value="HSSC-2">HSSC-2</option>
                  <option value="A-Level">A-Level</option>
                  <option value="Diploma">Diploma</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Group</label>
                <select name="hssc_group" class="select2 form-control form-control-lg">
                  <option value="Pre-Engineering">Pre-Engineering</option>
                  <option value="Pre-Medical">Pre-Medical</option>
                  <option value="Commerce">Commerce</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Board</label>
                <select name="hssc_board" class="select2 form-control form-control-lg">
                  <option value="Lahore">Lahore</option>
                  <option value="Faisalabad">Faisalabad</option>
                  <option value="Sahiwal">Sahiwal</option>
                  <option value="Multan">Multan</option>
                  <option value="Sarghoda">Sarghoda</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Institue</label>
                <input type="text" value="{{$userDetail->hssc_institue}}" name="hssc_institue" id="first-name" class="form-control" placeholder="Institue" />
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Passing Year</label>
                <select name="hssc_passing_year" class="select2 form-control form-control-lg">
                  @for($i = 2021;$i >= 1990; $i-- )
                  <option value="{{$i}}">{{$i}}</option>
                  @endfor
                </select>
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="first-name">Roll Number</label>
                <input type="number" value="{{$userDetail->hssc_roll_number}}" name="hssc_roll_number" id="first-name" class="form-control" />
              </div>
              <div class="form-group col-md-4">
                <label class="form-label" for="first-name">Obt. Marks</label>
                <input type="number" value="{{$userDetail->hssc_obt_marks}}" name="hssc_obt_marks" id="first-name" class="form-control" />
              </div>
              <div class="form-group col-md-4">
                <label class="form-label" for="first-name">Total Marks</label>
                <input type="number" value="{{$userDetail->hssc_total_marks}}" name="hssc_total_marks" id="first-name" class="form-control" />
              </div>
              <div class="form-group col-md-4">
                <div class="form-group">
                  <label for="customFile">Add Degree</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="hssc_document" id="customFile1" />
                    <label class="custom-file-label" for="customFile1">Choose file</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>

            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</section>
<!-- /Horizontal Wizard -->


@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/page-account-settings.js')) }}"></script>

<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>

<script>
  function uploadlogo() {
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
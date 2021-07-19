@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
@if ($message = Session::get('success'))
        

        <div class="content-body">


                           <!-- Alert Colors start -->
            <section id="alert-colors">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                
                                <div class="card-body">
                                  
                                        <div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">Success</h4>
                                            <div class="alert-body">
                                            {{ $message }}
                                            </div>
                                        </div>  
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
                
        
        </div>
    
@endif
  
@if ($message = Session::get('error'))
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow">

    </div>
    <div class="content-wrapper">

        <div class="content-body">


                           <!-- Alert Colors start -->
                <section id="alert-colors">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                
                                <div class="card-body">
                                  
                                    <div class="demo-spacing-0">
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Error</h4>
                                            <div class="alert-body">
                                                @php echo $message; @endphp
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        </div>   
                
    </div>
@endif
<div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
    <!-- Register v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="javascript:void(0);" class="brand-logo">
          
        <img style="width: 74%;" src="{{asset('logo/logo1.png')}}" alt="">
        </a>

        <h4 class="card-title mb-1"></h4>
        <p class="card-text mb-2">Download the <a href="#">Letter</a> and upload it with authorized verification. </p>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="auth-register-form mt-2" method="POST" action="{{ route('request-save') }}"  enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="register-username" class="form-label">University Name</label>
            <input type="text" class="form-control @error('university_name') is-invalid @enderror" id="register-username" name="university_name" placeholder="Name" aria-describedby="register-username" tabindex="1" autofocus value="{{ old('name') }}" />
            @error('university_name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="register-email" class="form-label">University Email</label>
            <input type="email" class="form-control @error('university_email') is-invalid @enderror" id="register-email" name="university_email" placeholder="Email" aria-describedby="register-email" tabindex="2" value="{{ old('email') }}" />
            @error('university_email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="register-email" class="form-label">University Website</label>
            <input type="text" class="form-control @error('university_website') is-invalid @enderror" id="register-email" name="university_website" placeholder="Email" aria-describedby="register-email" tabindex="2" value="{{ old('email') }}" />
            @error('university_website')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
              <label for="exampleFormControlTextarea1">Address</label>
              <textarea
                name="university_address"
                class="form-control @error('university_address') is-invalid @enderror"
                id="exampleFormControlTextarea1"
                rows="3"
                placeholder="Address"
              ></textarea> 
              @error('university_address')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
              <label for="exampleFormControlTextarea1">Why OnePlace?</label>
              <textarea
                name="description"
                class="form-control @error('description') is-invalid @enderror"
                id="exampleFormControlTextarea1"
                rows="3"
                placeholder="Why OnePlace?"
              ></textarea> 
              @error('description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="customFile">Upload Verified Letter</label>
            <div class="custom-file">
              <input  type="file"  name="letter" class="custom-file-input" id="customFile" />
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>

          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" required type="checkbox" id="register-privacy-policy" tabindex="4" />
              <label class="custom-control-label" for="register-privacy-policy">
                I agree to <a href="javascript:void(0);">privacy policy & terms</a>
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" tabindex="5">Submit Application</button>
        </form>

        <p class="text-center mt-2">
          <span>Back to </span>
          @if (Route::has('login'))
          <a href="{{ route('login') }}">
            <span>Log in</span>
          </a>
          @endif
        </p>
        

        <!-- <div class="divider my-2">
          <div class="divider-text">or</div>
        </div>

        <div class="auth-footer-btn d-flex justify-content-center">
          <a href="javascript:void(0)" class="btn btn-facebook">
            <i data-feather="facebook"></i>
          </a>
          <a href="javascript:void(0)" class="btn btn-twitter white">
            <i data-feather="twitter"></i>
          </a>
          <a href="javascript:void(0)" class="btn btn-google">
            <i data-feather="mail"></i>
          </a>
          <a href="javascript:void(0)" class="btn btn-github">
            <i data-feather="github"></i>
          </a>
        </div> -->
      </div>
    </div>
    <!-- /Register v1 -->
  </div>
</div>
@endsection

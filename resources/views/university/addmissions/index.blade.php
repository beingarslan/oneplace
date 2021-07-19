@extends('layouts/contentLayoutMaster')

@section('title', 'University Addmissions')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">
@endsection

@section('content')

<section id="basic-modals">
  <div class="row">
    <div class="col-6">
      <div class="card">
        
        <div class="card-body">
          <div class="demo-inline-spacing">
            <!-- Basic trigger modal -->
            <div class="basic-modal">
              <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#default">
                Add Addmission <i data-feather='plus'></i>
              </button>

              <!-- Modal -->
              <div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel1">Add Addmission</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <form class="form form-horizontal" action="{{route('university-saveaddmissions')}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="customFile">Cover (optional)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="cover" id="customFile" />
                                        <label class="custom-file-label" for="customFile">Choose Cover</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                <label for="contact-info-vertical">Description</label>
                                <input type="text" id="contact-info-vertical" class="form-control" name="description" placeholder="Description">
                                </div>
                            </div>  
                            <div class="col-12">
                                <div class="form-group">
                                <label for="contact-info-vertical">Last Date</label>
                                <input type="date" id="contact-info-vertical" class="form-control" name="last_date"  placeholder="Last Date">
                                </div>
                            </div>  
                            <div class="col-12">
                                <div class="form-group">
                                  <label for="contact-info-vertical">Program</label>
                                  <select name="programid" class="select2 form-control ">
                                    <option selected value="">Select Program</option>    
                                    @foreach($programs as $program)
                                      <option value="{{$program->id}}">{{$program->name}}</option>    
                                    @endforeach                                
                                  </select>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary waves-effect waves-float waves-light" >Save</button>
                    </div>
                  </div>
                    </form>
                </div>
              </div>
            </div>
            <!-- Basic trigger modal end -->

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div id="user-profile">
  



  <!-- profile info section -->
  <section id="profile-info">
    <div class="row">
     <!-- center profile info section -->
     <div class="col-lg-6 col-12 order-1 order-lg-2">
        @foreach($univeristyAddmissions as $univeristyAddmission)
        <!-- post 1 -->
        <div class="card">
          <div class="card-header">
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-start align-items-center mb-1">
              <!-- avatar -->
              <div class="avatar mr-1">
                <img
                  src="{{asset('university/logo/'.App\UniversityInformation::where('userid', Auth::user()->id)->pluck('logo')->first())}}"
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
                <a href="/university/view/program/{{$univeristyAddmission->programid}}" class="d-flex align-items-center">
                  
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
          <div class="card-footer">
          <button type="button" class="btn btn-primary btn-block waves-effect waves-float waves-light" data-toggle="modal" data-target="#defaultedit{{$univeristyAddmission->id}}"><i data-feather='edit'></i></button>
          </div>
        </div>
        <!--/ post 1 -->
        <!-- Edit Model -->
        <div
                  class="modal fade text-left modal-primary"
                  id="defaultedit{{$univeristyAddmission->id}}"
                  tabindex="-1"
                  role="dialog"
                  aria-labelledby="myModalLabel160"
                  aria-hidden="true"
                >
                    <form action="{{ route('university-updatedepartments') }}" method="post"  enctype="multipart/form-data"> 
                        @csrf 
                        <input type="hidden" name="id" value="{{$univeristyAddmission->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel160">Univeristy Addmission ID #{{$univeristyAddmission->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                <div class="row">
                                   
                                    <div class="col-12">
                                        <div class="form-group">
                                        <label for="contact-info-vertical">Description</label>
                                        <input type="text" id="contact-info-vertical" class="form-control" name="description" value="{{$univeristyAddmission->description}}" placeholder="Description">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                          <label for="contact-info-vertical">Last Date</label>
                                          <input type="date" id="contact-info-vertical" class="form-control" name="last_date"  value="{{$univeristyAddmission->last_date}}" placeholder="Last Date">
                                        </div>
                                    </div>  
                                    <div class="col-12">
                                        <div class="form-group">
                                          <label for="contact-info-vertical">Program</label>
                                          <select name="programid" class="select2 form-control ">
                                            @foreach($programs as $program)
                                              <option {{ $program->id == $univeristyAddmission->programid ? 'selected' : '' }} value="{{$program->id}}">{{$program->name}}</option>    
                                            @endforeach                                
                                          </select>
                                        </div>
                                    </div>   
                                    
                                    <div class="col-12">
                                    <div class="demo-inline-spacing">
            
                                    <div class="custom-control custom-control-success custom-radio">
                                    <input
                                        type="radio"
                                        id="customColorRadio3{{$univeristyAddmission->id}}"
                                        name="status"
                                        class="custom-control-input"
                                        value="1"
                                        {{$univeristyAddmission->status=='1'? 'checked':'' }}
                                    />
                                    <label class="custom-control-label" for="customColorRadio3{{$univeristyAddmission->id}}">Active</label>
                                    </div>
                                    <div class="custom-control custom-control-danger custom-radio">
                                    <input
                                        type="radio"
                                        id="customColorRadio5{{$univeristyAddmission->id}}"
                                        name="status"
                                        class="custom-control-input"
                                        value="0"
                                        
                                        {{$univeristyAddmission->status=='0'? 'checked':'' }}
                                    />
                                    <label class="custom-control-label" for="customColorRadio5{{$univeristyAddmission->id}}">In-Active</label>
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
        <!-- End Edit Model -->
        @endforeach
       
      </div>
      <!--/ center profile info section -->

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


@extends('layouts/contentLayoutMaster')

@section('title', 'Manage Eligibilities')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')
<section id="basic-modals">
  <div class="row">
    <div class="col-12">
      <div class="card">
        
        <div class="card-body">
          <div class="demo-inline-spacing">
            <!-- Basic trigger modal -->
            <div class="basic-modal">
              <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#default">
                Add Eligibility <i data-feather='plus'></i>
              </button>

              <!-- Modal -->
              <div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel1">Add Eligibility</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <form class="form form-horizontal" action="{{route('university-saveeligibilities')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                <label for="first-name-vertical">Degree Name</label>
                                <input type="text" id="first-name-vertical" class="form-control" name="degree" placeholder="Degree Name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                <label for="email-id-vertical">Minimum Percentage Required</label>
                                <input type="number" min="1" max="100" id="email-id-vertical" class="form-control" name="marks" placeholder="Minimum Percentage Required">
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
                                  <label for="contact-info-vertical">Program</label>
                                  <select name="programid" class="select2 form-control form-control-lg">
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
<!-- Basic table -->
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div  style="padding: 20px;" class="card">
        <table id="myTable" class="datatables-basic table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Degree</th>
              <th>Marks</th>
              <th>Program</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
                @foreach($eligibilitys as $eligibility)
                <tr>
                  <td>#{{$eligibility->id}}</td>
                  <td>{{$eligibility->degree}}</td>
                  <td>{{$eligibility->marks}}%</td>
                  <td>{{$eligibility->program->name}}</td>
                  <td>{{$eligibility->description}}</td>
                  <td >
                    @if($eligibility->status=='1')
                    <div class="badge badge-glow badge-success">Active</div>
                    @else
                    <div class="badge badge-glow badge-danger">In-Active</div>
                    @endif
                </td>
                  <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#primary{{$eligibility->id}}"><i data-feather='edit'></i></button>
                          <!-- <button type="button" class="btn btn-sm btn-outline-primary"><i data-feather="twitter"></i></button>
                          <button type="button" class="btn btn-sm btn-outline-primary"><i data-feather="instagram"></i></button> -->
                      </div>
                  </td>
                </tr>

                <!-- Modal -->
                <div
                  class="modal fade text-left modal-primary"
                  id="primary{{$eligibility->id}}"
                  tabindex="-1"
                  role="dialog"
                  aria-labelledby="myModalLabel160"
                  aria-hidden="true"
                >
                    <form action="{{ route('university-updateeligibilities') }}" method="post"> 
                        @csrf 
                        <input type="hidden" name="id" value="{{$eligibility->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel160">Eligibility ID #{{$eligibility->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                
                                    
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                        <label for="first-name-vertical">Degree Name</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="degree" value="{{$eligibility->degree}}" placeholder="Degree Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                        <label for="email-id-vertical">Minimum Percentage Required</label>
                                        <input type="number" min="1" max="100" id="email-id-vertical" class="form-control" value="{{$eligibility->marks}}" name="marks" placeholder="Minimum Percentage Required">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                        <label for="contact-info-vertical">Description</label>
                                        <input type="text" id="contact-info-vertical" class="form-control" name="description" value="{{$eligibility->description}}" placeholder="Description">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                          <label for="contact-info-vertical">Program</label>
                                          <select name="programid" class=" form-control form-control-lg">
                                              <option selected value="">Select Program</option>  
                                              @foreach($programs as $program)
                                                <option {{$eligibility->programid == $program->id ? 'selected' : '' }}  value="{{$program->id}}">{{$program->name}}</option>    
                                              @endforeach                                
                                          </select>
                                        </div>
                                    </div>    
                                    <div class="col-12">
                                    <div class="demo-inline-spacing">
            
                                    <div class="custom-control custom-control-success custom-radio">
                                    <input
                                        type="radio"
                                        id="customColorRadio3{{$eligibility->id}}"
                                        name="status"
                                        class="custom-control-input"
                                        value="1"
                                        {{$eligibility->status=='1'? 'checked':'' }}
                                    />
                                    <label class="custom-control-label" for="customColorRadio3{{$eligibility->id}}">Active</label>
                                    </div>
                                    <div class="custom-control custom-control-danger custom-radio">
                                    <input
                                        type="radio"
                                        id="customColorRadio5{{$eligibility->id}}"
                                        name="status"
                                        class="custom-control-input"
                                        value="0"
                                        
                                        {{$eligibility->status=='0'? 'checked':'' }}
                                    />
                                    <label class="custom-control-label" for="customColorRadio5{{$eligibility->id}}">In-Active</label>
                                    </div>
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
                    </form>
                </div>
                @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
</section>
<!--/ Basic table -->


@endsection


@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script>
      $(document).ready( function () {
            $('#myTable').DataTable();
        } );

  </script>
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  </script>



@endsection
{"csrf_protection":"0","login_open_in_modal":"1","login_max_attempts":"5","login_decay_minutes":"15","recaptcha_activation":"1","recaptcha_site_key":"6Ld_aOgaAAAAAGQ96j7marmd9oElumUHAOzCrA8P","recaptcha_secret_key":"6Ld_aOgaAAAAAGQ96j7marmd9oElumUHAOzCrA8P","recaptcha_version":"v3","recaptcha_skip_ips":null}
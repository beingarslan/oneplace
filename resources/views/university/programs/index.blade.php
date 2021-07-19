
@extends('layouts/contentLayoutMaster')

@section('title', 'Manage Programs')

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
                Add Program <i data-feather='plus'></i>
              </button>

              <!-- Modal -->
              <div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel1">Add Program</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <form class="form form-horizontal" action="{{route('university-saveprograms')}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                <label for="first-name-vertical">Name</label>
                                <input type="text" id="first-name-vertical" class="form-control" name="name" placeholder="Name">
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
                                  <label for="contact-info-vertical">Department</label>
                                  <select name="departmentid" class="select2 form-control form-control-lg">
                                    @foreach($departments as $department)
                                      <option value="{{$department->id}}">{{$department->name}}</option>    
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
              <th>Name</th>
              <th>Department</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
                @foreach($programs as $program)
                <tr>
                  <td>#{{$program->id}}</td>
                  <td>{{$program->name}}</td>
                  <td>{{$program->department->name}}</td>
                  <td>{{$program->description}}</td>
                  <td >
                    @if($program->status=='1')
                    <div class="badge badge-glow badge-success">Active</div>
                    @else
                    <div class="badge badge-glow badge-danger">In-Active</div>
                    @endif
                </td>
                  <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#primary{{$program->id}}"><i data-feather='edit'></i></button>
                          <!-- <button type="button" class="btn btn-sm btn-outline-primary"><i data-feather="twitter"></i></button>
                          <button type="button" class="btn btn-sm btn-outline-primary"><i data-feather="instagram"></i></button> -->
                      </div>
                  </td>
                </tr>

                <!-- Modal -->
                <div
                  class="modal fade text-left modal-primary"
                  id="primary{{$program->id}}"
                  tabindex="-1"
                  role="dialog"
                  aria-labelledby="myModalLabel160"
                  aria-hidden="true"
                >
                    <form action="{{ route('university-updateprograms') }}" method="post"  enctype="multipart/form-data"> 
                        @csrf 
                        <input type="hidden" name="id" value="{{$program->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel160">Program ID #{{$program->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                  <div class="row">
                                      <div class="col-12">
                                          <div class="form-group">
                                          <label for="first-name-vertical">Name</label>
                                          <input type="text" id="first-name-vertical" class="form-control" name="name" value="{{$program->name}}" placeholder="Name">
                                          </div>
                                      </div>
                                      <div class="col-12">
                                          <div class="form-group">
                                            <label for="contact-info-vertical">Department</label>
                                            <select name="departmentid" class="select form-control form-control-lg">
                                                
                                                @foreach($departments as $department)
                                                  <option {{$program->departmentid == $department->id ? 'selected' : '' }}  value="{{$department->id}}" >{{$department->name}}</option>    
                                                @endforeach                                
                                            </select>
                                          </div>
                                      </div>
                                      <div class="col-12">
                                          <div class="form-group">
                                          <label for="contact-info-vertical">Description</label>
                                          <input type="text" id="contact-info-vertical" class="form-control" name="description" value="{{$program->description}}" placeholder="Description">
                                          </div>
                                      </div>
                                      
                                      <div class="col-12">
                                        <div class="demo-inline-spacing">
              
                                          <div class="custom-control custom-control-success custom-radio">
                                            <input
                                              type="radio"
                                              id="customColorRadio3{{$program->id}}"
                                              name="status"
                                              class="custom-control-input"
                                              value="1"
                                              {{$program->status=='1'? 'checked':'' }}
                                            />
                                            <label class="custom-control-label" for="customColorRadio3{{$program->id}}">Active</label>
                                          </div>
                                        <div class="custom-control custom-control-danger custom-radio">
                                          <input
                                              type="radio"
                                              id="customColorRadio5{{$program->id}}"
                                              name="status"
                                              class="custom-control-input"
                                              value="0"
                                              
                                              {{$program->status=='0'? 'checked':'' }}
                                          />
                                          <label class="custom-control-label" for="customColorRadio5{{$program->id}}">In-Active</label>
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

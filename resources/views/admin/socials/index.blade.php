
@extends('layouts/contentLayoutMaster')

@section('title', 'Manage Socials')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
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
                Add Social <i data-feather='plus'></i>
              </button>

              <!-- Modal -->
              <div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel1">Add Social</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <form class="form form-horizontal" action="{{route('admin-savesocials')}}" method="post">
                    @csrf
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="first-name">Name</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="first-name" class="form-control" name="name" placeholder="Name">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="email-id">Icon</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="email-id" class="form-control" name="icon" placeholder="Icon">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="contact-info">Tag</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="contact-info" class="form-control" name="tag" placeholder="Tag">
                                        </div>
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
              <th>Icon</th>
              <th>Tag</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
                @foreach($socials as $social)
                <tr>
                  <td>#{{$social->id}}</td>
                  <td>{{$social->name}}</td>
                  <td><?php echo $social->icon; ?></td>
                  <td>{{$social->tag}} </td>
                  <td >
                    @if($social->status=='1')
                    <div class="badge badge-glow badge-success">Active</div>
                    @else
                    <div class="badge badge-glow badge-danger">In-Active</div>
                    @endif
                </td>
                  <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#primary{{$social->id}}"><i data-feather='edit'></i></button>
                          <!-- <button type="button" class="btn btn-sm btn-outline-primary"><i data-feather="twitter"></i></button>
                          <button type="button" class="btn btn-sm btn-outline-primary"><i data-feather="instagram"></i></button> -->
                      </div>
                  </td>
                </tr>

                <!-- Modal -->
                <div
                  class="modal fade text-left modal-primary"
                  id="primary{{$social->id}}"
                  tabindex="-1"
                  role="dialog"
                  aria-labelledby="myModalLabel160"
                  aria-hidden="true"
                >
                    <form action="{{ route('admin-updatesocials') }}" method="post"> 
                        @csrf 
                        <input type="hidden" name="id" value="{{$social->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel160">Social ID #{{$social->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    
                                    <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="first-name">Name</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="first-name" class="form-control" name="name" placeholder="Name" value="{{$social->name}}">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="email-id">Icon</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="email-id" class="form-control" name="icon" placeholder="Icon" value="{{$social->icon}}">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="contact-info">Tag</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="contact-info" class="form-control" name="tag" placeholder="Tag" value="{{$social->tag}}">
                                        </div>
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
@endsection
@section('page-script')
  {{-- Page js files --}}
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

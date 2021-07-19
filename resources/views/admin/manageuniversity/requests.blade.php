
@extends('layouts/contentLayoutMaster')

@section('title', 'Manage Universities Requests')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('content')

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
              <th>Email</th>
              <th>Website</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
                @foreach($universityRequests as $universityRequest)
                <tr>
                  <td>{{$universityRequest->id}}</td>
                  <td>{{$universityRequest->university_name}}</td>
                  <td>{{$universityRequest->university_email}}</td>
                  <td>{{$universityRequest->university_website}} <a href="{{$universityRequest->university_website}}" target="_blank" rel="noopener noreferrer"><i data-feather='external-link'></i></a></td>
                  <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#primary{{$universityRequest->id}}"><i data-feather='edit'></i></button>
                          <!-- <button type="button" class="btn btn-sm btn-outline-primary"><i data-feather="twitter"></i></button>
                          <button type="button" class="btn btn-sm btn-outline-primary"><i data-feather="instagram"></i></button> -->
                      </div>
                  </td>
                </tr>

                <!-- Modal -->
                <div
                  class="modal fade text-left modal-primary"
                  id="primary{{$universityRequest->id}}"
                  tabindex="-1"
                  role="dialog"
                  aria-labelledby="myModalLabel160"
                  aria-hidden="true"
                >
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel160">Request ID #{{$universityRequest->id}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="media">
                              
                              <div class="media-body">
                                <h5 class="mb-0">{{$universityRequest->university_name}}</h5>
                                <small class="text">Application Date: {{$universityRequest->created_at->format('d M, Y')}}</small>
                              </div>
                            </div>
                            
                          </div>
                          <small ><b>Email: </b>{{$universityRequest->university_email}}</small><br>
                          <small ><b>Website:</b> {{$universityRequest->university_website}}</small><br>
                          <small ><b>Address:</b> {{$universityRequest->university_address}}</small><br>
                          <p class="card-text mb-2">
                          <b>Description: </b> {{$universityRequest->description}}
                          </p>
                          
                          <a href="/download/{{$universityRequest->letter}}" class="btn btn-outline-primary btn-block waves-effect waves-float waves-light">Download the letter</a>
                        </div>
                      </div>
                      <div class="modal-footer">
                      
                        <form action="{{ route('request-reject') }}" method="post"> @csrf <input type="hidden" name="id" value="{{$universityRequest->id}}"><button type="submit" class="btn btn-primary">Reject</button></form>
                        <form action="{{ route('request-accept') }}" method="post"> @csrf <input type="hidden" name="id" value="{{$universityRequest->id}}"><button type="submit" class="btn btn-success">Accept</button></form>
                      </div>
                    </div>
                  </div>
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

  <script>
    function accept(){
      $.ajax({ 
          type:'POST',
          url:"{{ route('request-accept') }}",
          data:{
            id: id
          },
          success:function(data){
                //updateDeliveryInterval(data);
                // var location = data.location;
                // $('#pickup_address').val(location.address);
                // $('#pickup_unit').val(location.unit);
                // $('#pickup_phone').val(location.phone);
                // $('#pickup_sender').val(location.phone);

          if(data=='done')
          {
            document.location = "/admin/univeristy/requests";
          }
          else{
            return false;
          }
        }
      });
    }
  </script>

<script>
    function reject(id){
      $.ajax({ 
          type:'POST',
          url:"{{ route('request-reject') }}",
          data:{
            id: id
          },
          success:function(data){
                //updateDeliveryInterval(data);
                // var location = data.location;
                // $('#pickup_address').val(location.address);
                // $('#pickup_unit').val(location.unit);
                // $('#pickup_phone').val(location.phone);
                // $('#pickup_sender').val(location.phone);

          if(data=='done')
          {
            document.location = "/admin/univeristy/requests";
          }
          else{
            return false;
          }
        }
      });
    }
  </script>

@endsection

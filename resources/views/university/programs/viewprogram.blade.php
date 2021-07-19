@extends('layouts/contentLayoutMaster')

@section('title', $program->name)

@section('content')


<!-- Accordion with margin start -->
<section id="accordion-with-margin">
  <div class="row">
    <div class="col-sm-12">
      <div class="card collapse-icon">
        <div class="card-header">
          <h4 class="card-title">{{$program->name}}</h4>
          <a href="#" data-toggle="modal" data-target="#primary{{$program->id}}"> <i data-feather='edit'></i></a>

        </div>
        <div class="card-body">
          <p class="card-text">
            {{$program->description}}
          </p>
          <div class="collapse-margin" id="accordionExample">
            <div class="card">
              <div
                class="card-header"
                id="headingOne"
                data-toggle="collapse"
                role="button"
                data-target="#collapseOne"
                aria-expanded="false"
                aria-controls="collapseOne"
              >
                <span class="lead collapse-title"> More Info </span>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <?php echo $program->more_info; ?>
                </div>
              </div>
            </div>
            <div class="card">
              <div
                class="card-header"
                id="headingTwo"
                data-toggle="collapse"
                role="button"
                data-target="#collapseTwo"
                aria-expanded="false"
                aria-controls="collapseTwo"
              >
                <span class="lead collapse-title"> Criteria </span>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <?php echo $program->criteria; ?>
                </div>
              </div>
            </div>
            <div class="card">
              <div
                class="card-header"
                id="headingThree"
                data-toggle="collapse"
                role="button"
                data-target="#collapseThree"
                aria-expanded="false"
                aria-controls="collapseThree"
              >
                <span class="lead collapse-title"> Award Of Degree </span>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  <?php echo $program->award_of_degree; ?>
                </div>
              </div>
            </div>
            <div class="card">
              <div
                class="card-header"
                id="headingFour"
                data-toggle="collapse"
                role="button"
                data-target="#collapseFour"
                aria-expanded="false"
                aria-controls="collapseFour"
              >
                <span class="lead collapse-title"> Eligibilities </span>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                  
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Degree</th>
                          <th>Minimum Marks</th>
                          <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($eligibilities as $eligibility)
                        <tr>
                          
                          <td>{{$eligibility->degree}}</td>
                          <td>{{$eligibility->marks}}%</td>
                          <td>{{$eligibility->description}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Accordion with margin end -->



<!-- Program Model -->

<!-- Modal -->
                <div
                  class="modal fade text-left modal-primary"
                  id="primary{{$program->id}}"
                  tabindex="-1"
                  role="dialog"
                  aria-labelledby="myModalLabel160"
                  aria-hidden="true"
                >
                    <form action="{{ route('university-updateprogram') }}" method="post"  enctype="multipart/form-data"> 
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
                                          <label for="contact-info-vertical">More Info</label>
                                            <textarea
                                              class="form-control"
                                              id="more_info"
                                              rows="3"
                                              name="more_info"
                                              placeholder="More Info"
                                            ><?php echo $program->more_info; ?></textarea>     
                                          </div>
                                      </div>
                                      <div class="col-12">
                                          <div class="form-group">
                                            <label for="contact-info-vertical">Criteria</label>
                                            <textarea
                                              class="form-control"
                                              id="criteria"
                                              rows="3"
                                              name="criteria"
                                              placeholder="Criteria"
                                            ><?php echo $program->criteria; ?></textarea>                                           
                                          </div>
                                      </div>
                                      <div class="col-12">
                                          <div class="form-group">
                                          <label for="contact-info-vertical">Award Of Degree</label>
                                            <textarea
                                              class="form-control"
                                              id="award_of_degree"
                                              rows="3"
                                              name="award_of_degree"
                                              placeholder="Award Of Degree"
                                            ><?php echo $program->award_of_degree; ?></textarea>     
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
                        </div>
                    </form>
                </div>

<!-- End Program Model -->
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/components/components-collapse.js'))}}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
                <script>
                        ClassicEditor
                                .create( document.querySelector( '#more_info' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>
                <script>
                        ClassicEditor
                                .create( document.querySelector( '#criteria' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>
                <script>
                        ClassicEditor
                                .create( document.querySelector( '#award_of_degree' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>


@endsection

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



@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/components/components-collapse.js'))}}"></script>

@endsection

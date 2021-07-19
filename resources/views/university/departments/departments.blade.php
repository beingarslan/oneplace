@extends('layouts/contentLayoutMaster')

@section('title', 'Departments')

@section('content')
<!-- Examples -->
<section id="card-demo-example">
  <div class="row match-height">
    @foreach($departments as $department)
    <div class="col-md-6 col-lg-4">
      <div class="card text-center">
        <img class="card-img-top" src="{{asset('university/departments/'.$department->cover)}}" alt="Card image cap" />
        <div class="card-body">
          <h4 class="card-title">{{$department->name}}</h4>
          <p class="card-text">
            {{$department->description}}
          </p>

        </div>
        <div class="card-footer">
            <a href="/university/view/{{$department->id}}/programs" class="btn btn-primary waves-effect">View Programs</a>
        </div>
      </div>
    </div>
    @endforeach
    
  </div>
</section>
<!-- Examples -->



@endsection
